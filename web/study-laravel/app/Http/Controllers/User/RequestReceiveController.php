<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestReceiveController extends Controller
{
    public function index(Request $request){
        $request_uri = $request->path();
        $request_url = $request->url();
        $request_url_with_query = $request->fullUrl();
        $is_from_request = $request->is('request/*');
        $method = $request->method();
        $is_post_method = $request->isMethod('post');

        return view('user.request_receive', compact(
            'request_uri',
            'request_url',
            'request_url_with_query',
            'is_from_request',
            'method',
            'is_post_method'
        ));
    }

    public function store(Request $request)
    {
        $message = $request->input('message');
        $request_uri = $request->path();
        $request_url = $request->url();
        $request_url_with_query = $request->fullUrl();
        $is_from_request = $request->is('request_*');
        $method = $request->method();
        $is_post_method = $request->isMethod('post');

        return view('user.request_receive', compact(
            'message',
            'request_uri',
            'request_url',
            'request_url_with_query',
            'is_from_request',
            'method',
            'is_post_method'
        ));
    }
}
