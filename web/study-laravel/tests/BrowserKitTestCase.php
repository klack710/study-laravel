<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as TestCase;

abstract class BrowserKitTestCase extends TestCase
{
    public $baseUrl = 'http://localhost';
    use CreatesApplication;
}