<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Contracts\UpdatePromoCode as UpdatePromoCodeInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class UpdatePromoCode extends PromoCodeRepository implements UpdatePromoCodeInterface
{

    private $updatableFields = [
        'type',
        'title',
        'pct_discount',
        'amount_discount',
        'pct_shipping_discount',
        'max_uses',
        'start_date',
        'end_date',
        'first_order_only',
        'one_use_only',
        'customer_one_use_only',
        'action',
    ];

    /**
     * @param int $id
     * @param PromoCode $promoCode
     */
    public function make(int $id, PromoCode $promoCode): void
    {
        $data = $promoCode->toArray();

        foreach ($data as $key => $datum) {
            if (!in_array($key, $this->updatableFields)) {
                unset($data[$key]);
            }
        }

        $this->model->where('id', $id)->update($data);
    }
}