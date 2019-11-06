<?php

namespace Omatech\LaravelPromoCodes\Tests;

use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\LaravelPromoCodesServiceProvider;
use Omatech\LaravelPromoCodes\Models\PromoCode;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    protected $promoCodeModelName;
    protected $promoCodeDomain;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->promoCodeModelName = PromoCode::class;
        $this->promoCodeDomain = app()->make(PromoCodeInterface::class);

        $this->withFactories(realpath(dirname(__DIR__) . '/database/factories'));
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    public function getPackageProviders($app)
    {
        return [
            LaravelPromoCodesServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    public function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/2019_07_19_000000_create_promo_codes_table.php';
        include_once __DIR__ . '/../database/migrations/2019_07_23_create_model_promo_codes_table.php';
        include_once __DIR__ . '/resources/0000_00_00_000000_create_products_table.php';
        include_once __DIR__ . '/resources/2014_10_12_000000_create_users_table.php';

        (new \CreateUsersTable())->up();
        (new \CreateProductsTable())->up();
        (new \CreatePromoCodesTable())->up();
        (new \CreateModelPromoCodesTable())->up();
    }
}