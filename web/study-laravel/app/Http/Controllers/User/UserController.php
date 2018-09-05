<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * ユーザーリポジトリの実装
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * 新しいコントローラインスタンスの生成
     *
     * @param  UserRepository  $users
     * @return void
     */
    // UserServiceProviderにおける、各結合の確認
    // public function __construct($users)
    // インターフェース結合の確認
    // public function __construct(UserRepositoryInterface $users)
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * 指定ユーザーのプロフィール表示
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->users->find($id);

        return view('user.user.profile', ['user' => $user]);
    }
}