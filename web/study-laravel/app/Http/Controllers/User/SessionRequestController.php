<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionRequestController extends Controller
{
    public function index(Request $request)
    {
        $get_key = $request->session()->get('request_key');
        $get_key_default = $request->session()->get('request_key', 'default');

        $all = $request->session()->all();

        $session_key = session('session_key');
        $session_key_default = session('session_key', 'default');

        $request->session()->put('session_key', 'from_request');
        session(['request_key' => 'from_session']);

        return view('user.session_request', compact(
            'get_key',
            'get_key_default',
            'all',
            'session_key',
            'session_key_default'
        ));
    }
    public function store(Request $request)
    {
        $request->session()->flush();
        $request->session()->flash('session_flash', $request->input('session_flash'));

        $get_key = $request->session()->get('request_key');
        $get_key_default = $request->session()->get('request_key', 'default');
        $all = $request->session()->all();
        $session_key = session('session_key');
        $session_key_default = session('session_key', 'default');

        return view('user.session_request', compact(
            'get_key',
            'get_key_default',
            'all',
            'session_key',
            'session_key_default'
        ));
    }
}
