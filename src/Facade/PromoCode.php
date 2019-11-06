<?php

namespace Omatech\LaravelPromoCodes\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Omatech\LaravelPromoCodes\Skeleton\SkeletonClass
 */
class PromoCode extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'promo-code';
    }
}
