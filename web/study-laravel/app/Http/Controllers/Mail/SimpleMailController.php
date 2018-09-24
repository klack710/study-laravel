<?php

namespace App\Http\Controllers\Mail;

use App\Mail\SimpleMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SimpleMailController extends Controller
{
    /**
     * メール送信
     *
     */
    public function send_mail()
    {
        Mail::to('crimsondrop710@gmail.com')
            ->send(new SimpleMail());
        return "メール送ったよ！";
    }

}