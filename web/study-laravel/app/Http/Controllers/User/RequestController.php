<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index(){
        return view('user.request');
    }

    public function store(Request $request)
    {
        $message = $request->input('message');

        return view('user.request', compact('message'));
    }
}
