<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use App\Observers\UserObserver;
use App\Http\Controllers\User\UserController;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // シンプルな結合
        // $this->app->bind(
        //     'App\Http\Controllers\User\UserController', function ($app) {
        //         return new UserController(
        //             $app->make('App\Repositories\User\UserRepository')
        //         );
        //     }
        // );

        // シングルトン結合
        // $this->app->singleton(
        //     'App\Http\Controllers\User\UserController', function ($app) {
        //         return new UserController($app->make('App\Repositories\User\UserRepository'));
        //     }
        // );

        // インスタンス結合
        // $controller = new UserController(new UserRepository(new User()));
        // $this->app->instance('App\Http\Controllers\User\UserController', $controller);

        // プリミティブ結合
        // $this->app->when('App\Http\Controllers\User\UserController')
        //     ->needs('$user')
        //     ->give(2);

        // インターフェース結合
        // $this->app->bind(
        //     UserRepositoryInterface::class,
        //     UserRepository::class
        // );
    }
}
