<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;
use Illuminate\Support\Facades\Cache;

class WebCacheHelperTest extends BrowserKitTestCase
{
    /**
     * 基本的なテスト機能の例
     *
     * @return void
     */
    public function testAccessCacheHelper_正常系()
    {
        Cache::shouldReceive('get')
            ->with('key', null)
            ->andReturn('value');

        $this->visit('/cache_helper')
            ->see('value');
    }
}