<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestReceiveController extends Controller
{
    public function index(Request $request) {
        $all = $request->all();
        $upfile = $request->upfile;
        $file_upfile = $request->file('upfile');
        $hasfile = $request->hasfile('upfile');
        if ($hasfile) {
            $isValid = $request->file('upfile')->isValid();
            $path = $request->upfile->path();
            $store = $request->upfile->store('images', 'public');
            $extension = $request->upfile->extension();
        } else {
            $isValid = null;
            $path = null;
            $store = null;
            $extension = null;
        }
        $message = $request->message;
        $message_has = $request->has('message');
        $message_filled = $request->filled('message');
        $message_input = $request->input('message', 'messageがないよ！');
        $message_query = $request->query('message', 'queryにmessageがないよ！');
        $request_uri = $request->path();
        $request_url = $request->url();
        $request_url_with_query = $request->fullUrl();
        $is_to_request = $request->is('request_*');
        $method = $request->method();
        $is_post_method = $request->isMethod('post');
        $cookie = $request->cookie('cookie_name');
        $encrypted_cookie = $request->cookie('encrypted_cookie_name');

        $request->flashOnly(['message']);

        return response()
            ->view('user.request_receive', compact(
                'all',
                'upfile',
                'file_upfile',
                'hasfile',
                'isValid',
                'extension',
                'path',
                'store',
                'message',
                'message_has',
                'message_filled',
                'message_input',
                'message_query',
                'request_uri',
                'request_url',
                'request_url_with_query',
                'is_to_request',
                'method',
                'is_post_method',
                'cookie',
                'encrypted_cookie'
            ));
    }

    public function store(Request $request)
    {
        $all = $request->all();
        $upfile = $request->upfile;
        $file_upfile = $request->file('upfile');
        $hasfile = $request->hasfile('upfile');
        if ($hasfile) {
            $isValid = $request->file('upfile')->isValid();
            $path = $request->upfile->path();
            $store = $request->upfile->store('images', 'public');
            $storeAs = $request->upfile->storeAs('images', 'upfile.jpeg', 'public');
            $extension = $request->upfile->extension();
        } else {
            $isValid = null;
            $path = null;
            $store = null;
            $extension = null;
        }
        $message = $request->message;
        $message_has = $request->has('message');
        $message_filled = $request->filled('message');
        $message_input = $request->input('message', 'messageがないよ！');
        $message_query = $request->query('message', 'queryにmessageがないよ！');
        $request_uri = $request->path();
        $request_url = $request->url();
        $request_url_with_query = $request->fullUrl();
        $is_to_request = $request->is('request_*');
        $method = $request->method();
        $is_post_method = $request->isMethod('post');
        $cookie = $request->cookie('cookie_name');
        $encrypted_cookie = $request->cookie('encrypted_cookie_name');

        $request->flashOnly(['message']);

        return response()
            ->view('user.request_receive', compact(
                'all',
                'upfile',
                'file_upfile',
                'hasfile',
                'isValid',
                'extension',
                'path',
                'store',
                'storeAs',
                'message',
                'message_has',
                'message_filled',
                'message_input',
                'message_query',
                'request_uri',
                'request_url',
                'request_url_with_query',
                'is_to_request',
                'method',
                'is_post_method',
                'cookie',
                'encrypted_cookie'
            ))
            ->cookie('cookie_name', $request->input('for_cookie'), 10)
            ->cookie('encrypted_cookie_name', $request->input('encrypted_cookie'), 10);
    }
}
