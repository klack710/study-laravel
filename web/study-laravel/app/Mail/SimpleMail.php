<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
// use Illuminate\Bus\Queueable;
// use Illuminate\Queue\SerializesModels;

class SimpleMail extends Mailable
{
    // use Queueable, SerializesModels;

    /**
     * メッセージの生成
     * from関数とか使うと、差出人とか変えられる
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.simple_mail')
            ->attach('storage/test.png', [
                'as' => 'test_image.png',
                'mime' => 'image/png',
            ]);
    }
}
