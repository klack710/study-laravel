<?php

namespace Tests\Feature;

use DB;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @before
     * 参考:https://qiita.com/n-oota/items/e1890a6451fe33fb25f6
     */
    public function setUpFixtures()
    {
        if ($this->setUpHasRun) {
            // アプリケーションのセットアップが完了しているならそのまま実行
            $this->seed(__CLASS__ . 'Seeder');
        } else {
            // アプリケーションのセットアップが完了していないならコールバックで設定
            $this->afterApplicationCreated(function() {
                $this->seed(__CLASS__ . 'Seeder');
            });
        }
    }


    /**
     * 存在しないレコードとして、エラーをなげる
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     * @return void
     */
    public function testEloquentFail()
    {
        $model = User::findOrFail(4);
        $this->fail();
    }

    /**
     * Eloquentで取得するものはクエリビルダと違う比較。
     * どう違うかを確かめる場合は、assertEqualsでエラーの比較を見る
     *
     */
    public function testEloquentAndQueryBuilder()
    {
        $users_eloquent = User::get();
        $users_query_builder = DB::table('users')->get();

        $this->assertNotEquals($users_eloquent ,$users_query_builder);
    }

    public function testEloquentDelete()
    {
        $user = User::find(1);
        $user->delete();

        $users_query_builder = DB::table('users')->get();

        $this->assertSame(2 ,$users_query_builder->count());
    }
}

class EloquentTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'First_Name',
                'email' => 'first_email@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'id' => 2,
                'name' => 'Second_Name',
                'email' => 'second_email@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'id' => 3,
                'name' => 'Last_Name',
                'email' => 'last_email@gmail.com',
                'password' => bcrypt('secret'),
            ]
        ]);
    }
}