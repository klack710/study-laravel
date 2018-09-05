<?php

namespace App\Contracts;

class Publisher
{
    /**
     * ポッドキャストの公開
     *
     * @return void
     */
    public function publish($podcast)
    {
        var_dump('published');
    }
}