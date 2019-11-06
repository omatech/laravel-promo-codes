<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\FindAllPromoCodes as FindAllPromoCodesInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class FindAllPromoCodes extends PromoCodeRepository implements FindAllPromoCodesInterface
{

    /**
     * @return array
     */
    public function make(): array
    {
        $model = $this->model->all();

        if (empty($model)) {
            return [];
        }

        $list = [];
        foreach ($model as $value) {
            $promoCode = $this->promoCode;
            array_push($list, $promoCode->fromArray($value->toArray()));
        }

        return $list;
    }
}