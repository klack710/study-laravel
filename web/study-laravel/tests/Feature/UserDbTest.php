<?php

namespace Tests\Feature;

use DB;
use Tests\TestCase;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDbTest extends TestCase
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
     * A basic test example.
     *
     * @return void
     */
    public function testUserDb_whereとFirst()
    {
        $users = DB::table('users')->where('name', 'Second_Name')->first();

        $this->assertEquals('second_email@gmail.com' ,$users->email);
    }

    public function testUserDb_whereとvalue()
    {
        $value = DB::table('users')->where('name', 'Second_Name')->value('email');

        $this->assertEquals('second_email@gmail.com' ,$value);
    }

    public function testUserDb_pluck_with_key()
    {
        $emails = DB::table('users')->pluck('email', 'name');
        $expect = collect([
            'First_Name' => 'first_email@gmail.com',
            'Second_Name' => 'second_email@gmail.com',
            'Last_Name' => 'last_email@gmail.com',
        ]);

        $this->assertEquals($expect, $emails);
    }

    public function testUserDb_orderBy_pluck()
    {
        // 取得したとき、順番が保証出来ないのもわかるコード
        // orderByしないと、first, last, secondの順で取得してしまう。
        $emails = DB::table('users')->orderBy('id')->pluck('email');
        $expect = collect([
            0 => 'first_email@gmail.com',
            1 => 'second_email@gmail.com',
            2 => 'last_email@gmail.com',
        ]);

        $this->assertEquals($expect, $emails);
    }

    public function testUserDb_count()
    {
        // 取得したとき、順番が保証出来ないのもわかるコード
        // orderByしないと、first, last, secondの順で取得してしまう。
        $count = DB::table('users')->count();
        $count_second = DB::table('users')
            ->where('name', 'Second_Name')
            ->count();
        $hoge = DB::table('users')
            ->where('name', 'hoge')
            ->count();

        // TODO:マジックナンバーの対応
        $this->assertEquals(3, $count);
        $this->assertEquals(1, $count_second);
        $this->assertEquals(0, $hoge);
    }

    public function testUserDb_exists()
    {
        // 取得したとき、順番が保証出来ないのもわかるコード
        // orderByしないと、first, last, secondの順で取得してしまう。
        $exists = DB::table('users')->where('name', 'Second_Name')->exists();
        $exists_false = DB::table('users')->where('name', 'hoge')->exists();
        $doesnt_exist = DB::table('users')->where('name', 'hoge')->doesntExist();
        $doesnt_exist_false = DB::table('users')->where('name', 'Second_Name')->doesntExist();

        $this->assertTrue($exists);
        $this->assertFalse($exists_false);
        $this->assertTrue($doesnt_exist);
        $this->assertFalse($doesnt_exist_false);
    }

    public function testUserDb_inRandomOrder()
    {
        // TODO:ランダムな取得を10回しても保証は出来ないので、要検討
        $expect = [
            0 => 'first_email@gmail.com',
            1 => 'second_email@gmail.com',
            2 => 'last_email@gmail.com',
        ];

        for ($count = 0; $count < 10; $count++) {
            $val = DB::table('users')
                ->inRandomOrder()
                ->first();

            $this->assertContains($val->email, $expect);
        }
    }

    public function testUserDb_groupby_having()
    {
        $users_where = DB::table('users')
            ->select('id')
            ->groupBy('id')
            ->where('id', '>=', 2)
            ->get();

        $users_having = DB::table('users')
            ->select('id')
            ->groupBy('id')
            ->having('id', '>=', 2)
            ->get();

        $this->assertEquals($users_where, $users_having);
    }

    /**
     * havingは、groupby後の値でチェックするため、エラーが出る。
     *
     * @expectedException PDOException
     * @return void
     */
    public function testUserDb_groupby_having_エラーチェック()
    {
        $users_where = DB::table('users')
            ->select('name')
            ->groupBy('name')
            ->where('id', '>=', 2)
            ->get();

        $users_having = DB::table('users')
            ->select('name')
            ->groupBy('name')
            ->having('id', '>=', 2)
            ->get();

        $this->assertEquals($users_where, $users_having);
    }

    public function testUserDb_skip_take_offset_limit()
    {
        $blank = 1;
        $item_count = 2;

        $users_skip = DB::table('users')
            ->skip($blank)
            ->take($item_count)
            ->get();

        $users_offset = DB::table('users')
            ->offset($blank)
            ->limit($item_count)
            ->get();

        $this->assertEquals($users_skip, $users_offset);

        $blank = 2;
        $item_count = 1;

        $users_skip = DB::table('users')
            ->skip($blank)
            ->take($item_count)
            ->get();

        $users_offset = DB::table('users')
            ->offset($blank)
            ->limit($item_count)
            ->get();

        $this->assertEquals($users_skip, $users_offset);
    }

    /**
     * @dataProvider whenDataProvider
     */
    public function testUserDb_when($expect, $data)
    {

        $actual = DB::table('users')
                    ->when($data, function ($query, $where) {
                        return $query->where('name', '=', 'First_Name');
                    })
                    ->orderBy('id')
                    ->pluck('email')
                    ->toArray();

        $this->assertSame($expect, $actual);
    }

    public function whenDataProvider()
    {
        return [
            'trueのときは、where句が動いてfirst_email@gmail.comだけ返すこと' => [
                'expect' => [
                    0 => 'first_email@gmail.com',
                ],
                'data' => true
            ],
            'falseのときは、where句が動かないこと' => [
                'expect' => [
                    0 => 'first_email@gmail.com',
                    1 => 'second_email@gmail.com',
                    2 => 'last_email@gmail.com',
                ],
                'data' => false
            ],
        ];
    }

}

class UserDbTestSeeder extends Seeder
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