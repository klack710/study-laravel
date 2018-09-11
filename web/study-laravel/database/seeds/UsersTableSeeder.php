<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    const RANDOM_RECORD_COUNT = 10;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'First_Name',
            'email' => 'first_email@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Second_Name',
            'email' => 'second_email@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        for ($count = 0; $count < self::RANDOM_RECORD_COUNT; $count++) {
            DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Last_Name',
            'email' => 'last_email@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
