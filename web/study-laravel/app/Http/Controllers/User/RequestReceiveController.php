<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestReceiveController extends Controller
{
    public function index(Request $request){
        $all = $request->all();
        $message = $request->message;
        $message_has = $request->has('message');
        $message_input = $request->input('message', 'messageがないよ！');
        $message_query = $request->query('message', 'queryにmessageがないよ！');
        $request_uri = $request->path();
        $request_url = $request->url();
        $request_url_with_query = $request->fullUrl();
        $is_to_request = $request->is('request_*');
        $method = $request->method();
        $is_post_method = $request->isMethod('post');

        return view('user.request_receive', compact(
            'all',
            'message',
            'message_has',
            'message_input',
            'message_query',
            'request_uri',
            'request_url',
            'request_url_with_query',
            'is_to_request',
            'method',
            'is_post_method'
        ));
    }

    public function store(Request $request)
    {
        $all = $request->all();
        $message = $request->message;
        $message_has = $request->has('message');
        $message_input = $request->input('message', 'messageがないよ！');
        $message_query = $request->query('message', 'queryにmessageがないよ！');
        $request_uri = $request->path();
        $request_url = $request->url();
        $request_url_with_query = $request->fullUrl();
        $is_to_request = $request->is('request_*');
        $method = $request->method();
        $is_post_method = $request->isMethod('post');

        return view('user.request_receive', compact(
            'all',
            'message',
            'message_has',
            'message_input',
            'message_query',
            'request_uri',
            'request_url',
            'request_url_with_query',
            'is_to_request',
            'method',
            'is_post_method'
        ));
    }
}
