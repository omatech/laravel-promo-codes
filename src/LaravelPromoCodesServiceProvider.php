<?php

namespace Omatech\LaravelPromoCodes;

use Illuminate\Support\ServiceProvider;
use Omatech\LaravelPromoCodes\Api\PromoCode;
use Omatech\LaravelPromoCodes\Contracts\DisablePromoCode as DisablePromoCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCode as FindPromoCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCodeByCode as FindPromoCodeByCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\GeneratePromoCode as GeneratePromoCodeInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCode\DisablePromoCode;
use Omatech\LaravelPromoCodes\Repositories\PromoCode\FindPromoCode;
use Omatech\LaravelPromoCodes\Repositories\PromoCode\FindPromoCodeByCode;
use Omatech\LaravelPromoCodes\Repositories\PromoCode\GeneratePromoCode;

class LaravelPromoCodesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->binding();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('promo-codes.php'),
            ], 'config');

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'promo-codes');

        // Register the main class to use with the facade
        $this->app->singleton('promo-code', function () {
            return new PromoCode;
        });
    }

    /**
     *
     */
    private function binding(): void
    {
        $this->app->bind(DisablePromoCodeInterface::class, DisablePromoCode::class);
        $this->app->bind(FindPromoCodeInterface::class, FindPromoCode::class);
        $this->app->bind(GeneratePromoCodeInterface::class, GeneratePromoCode::class);
        $this->app->bind(FindPromoCodeByCodeInterface::class, FindPromoCodeByCode::class);
        $this->app->bind(\Omatech\LaravelPromoCodes\Contracts\PromoCode::class, \Omatech\LaravelPromoCodes\Domains\PromoCode::class);
    }
}
