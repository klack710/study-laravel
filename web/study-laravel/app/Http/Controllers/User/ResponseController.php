<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ResponseController extends Controller
{
    public function index(){
        return view('user.response');
    }
}
