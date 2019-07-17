<?php

namespace Omatech\LaravelPromoCodes\Tests;

use Omatech\LaravelPromoCodes\LaravelPromoCodesServiceProvider;
use Omatech\LaravelPromoCodes\Models\PromoCode;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    protected $promoCodeModelName;

    protected function setUp(): void
    {
        parent::setUp();

        $this->promoCodeModelName = PromoCode::class;

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
        include_once __DIR__ . '/../database/migrations/create_promo_codes_table.php.stub';

        (new \CreatePromoCodesTable())->up();
    }
}