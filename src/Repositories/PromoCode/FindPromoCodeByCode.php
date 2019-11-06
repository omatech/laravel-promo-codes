<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\FindPromoCodeByCode as FindPromoCodeByCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class FindPromoCodeByCode extends PromoCodeRepository implements FindPromoCodeByCodeInterface
{
    /**
     * @param string $code
     * @return null|PromoCode
     */
    public function make(string $code): ?PromoCode
    {
        $model = $this->model->with('user','referral')->where('code', $code)->first();
        
        if (is_null($model))
            return null;

        return $this->promoCode->fromArray($model->toArray());
    }
}