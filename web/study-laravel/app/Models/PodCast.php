<?php

namespace App\Models;

use Facades\App\Contracts\Publisher;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    public $timestamps = false;
    /**
     * ポッドキャストの公開
     *
     * @return void
     */
    public function publish()
    {
        Publisher::publish($this);
    }
}