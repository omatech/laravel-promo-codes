<?php

namespace Omatech\LaravelPromoCodes\Tests;

use Omatech\LaravelPromoCodes\Api\PromoCode;

class ApiTestCase extends BaseTestCase
{
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();

        $this->api = app()->make(PromoCode::class);
    }
}