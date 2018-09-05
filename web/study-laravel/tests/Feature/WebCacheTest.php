<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;
use Illuminate\Support\Facades\Cache;

class WebCacheTest extends BrowserKitTestCase
{
    /**
     * 基本的なテスト機能の例
     *
     * @return void
     */
    public function testAccessCache_正常系()
    {
        Cache::shouldReceive('get')
            ->once()
            ->with('key')
            ->andReturn('value');

        $this->visit('/cache')
            ->see('value');
    }
}