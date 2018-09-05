<?php

use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'User' , 'as' => 'user.'], function () {
    Route::resource('/', 'TopController');
    Route::resource('/request', 'RequestController');
    Route::resource('/request_receive', 'RequestReceiveController');
    Route::resource('/user', 'UserController');

    Route::view('/response', 'user.response')->name('response.index');

    Route::get('/response/123', function () {
        return [1, 2, 3];
    })->name('response.123');

    Route::get('/response/hello', function () {
        return response('Hello World', 200)
                    ->header('Content-Type', 'text/plain');
    })->name('response.hello');

    Route::get('response/redirect', function () {
        return redirect('/request_receive')
            ->cookie('cookie_name', 'redirect_from_response', 10);
    })->name('response.redirect');

    Route::get('response/redirect_2', function () {
        return redirect()->route('user.request_receive.index')
            ->with('status', 'redirect!')
            ->cookie('cookie_name', 'redirect_from_response_2', 10);
    })->name('response.redirect_2');

    Route::get('response/redirect_google', function () {
        return redirect()->away('https://www.google.com')
            ->cookie('cookie_name', 'redirect_for_google', 10);
    })->name('response.redirect_google');

    Route::get('response/json', function () {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    })->name('response.json');

    Route::get('response/echo_md', function () {
        return response()->streamDownload(function () {
            echo '` echo "ほにゃらら"`';
        }, 'test.md');
    })->name('response.echo_md');

    Route::get('response/foo', function () {
        return response()->caps('foo');
    })->name('response.foo');

    Route::get('download_jpeg', function () {
        return response()->download('storage/images/upfile.jpeg')->deleteFileAfterSend(true);
    })->name('dl_jpeg');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cache', function () {
    return Cache::get('key');
});

Route::get('/cache_helper', function () {
    return cache('key');
});