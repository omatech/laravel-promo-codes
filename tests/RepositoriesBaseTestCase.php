<?php

namespace Omatech\LaravelPromoCodes\Tests;

use Omatech\LaravelPromoCodes\Contracts\FindPromoCode;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCodeByCode;

class RepositoriesBaseTestCase extends BaseTestCase
{
    protected $findPromoCode;
    protected $findPromoCodeByCode;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->findPromoCode = app()->make(FindPromoCode::class);
        $this->findPromoCodeByCode = app()->make(FindPromoCodeByCode::class);

    }
}