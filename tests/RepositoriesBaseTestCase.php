<?php

namespace Omatech\LaravelPromoCodes\Tests;

use Omatech\LaravelPromoCodes\Contracts\DisablePromoCode;
use Omatech\LaravelPromoCodes\Contracts\FindAllPromoCodes;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCode;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCodeByCode;
use Omatech\LaravelPromoCodes\Contracts\GeneratePromoCode;

class RepositoriesBaseTestCase extends BaseTestCase
{
    protected $disablePromoCode;
    protected $findPromoCode;
    protected $findAllPromoCode;
    protected $findPromoCodeByCode;
    protected $generatePromoCode;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->disablePromoCode = app()->make(DisablePromoCode::class);
        $this->findPromoCode = app()->make(FindPromoCode::class);
        $this->findAllPromoCode = app()->make(FindAllPromoCodes::class);
        $this->findPromoCodeByCode = app()->make(FindPromoCodeByCode::class);
        $this->generatePromoCode = app()->make(GeneratePromoCode::class);

    }
}