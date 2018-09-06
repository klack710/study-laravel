<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Db;
use App\Http\Controllers\Controller;

class DbUserController extends Controller
{
    /**
     *
     * データベースの操作確認
     *
     * @return Response
     */
    public function index()
    {
        DB::listen(function ($query) {
            dump($query->sql);
            dump($query->bindings);
            dump($query->time);
        });

        DB::transaction(function () {
            DB::delete('delete from users where name = ?', ['name999']);
            DB::delete('delete from users where name = ?', ['name1000']);
            DB::delete('delete from users where name = ?', ['name1001']);

            DB::insert(
                'insert into users (name, email, password) values (?, ?, ?)',
                ['name999', '999@mail.com', 'password']
            );
            DB::insert(
                'insert into users (name, email, password) values (?, ?, ?)',
                ['name1000', '1000@mail.com', 'password']
            );
            DB::insert(
                'insert into users (name, email, password) values (?, ?, ?)',
                ['name1001', '1001@mail.com', 'password']
            );

            $affected = DB::update('update users set password = "password100" where name = ?', ['name1000']);
            $deleted = DB::delete('delete from users where name = ?', ['name1001']);
        }, 5);

        $select = DB::select('select * from users');
        return dump($select);
    }
}