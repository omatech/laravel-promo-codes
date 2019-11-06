<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\DisablePromoCode as DisablePromoCodeInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class DisablePromoCode extends PromoCodeRepository implements DisablePromoCodeInterface
{
    /**
     * @param int $id
     * @throws \Throwable
     */
    public function make(int $id): void
    {
        $isDisabled = $this->model->where('id', $id)->update([
            'active' => false
        ]);

        throw_if(!$isDisabled, \Exception::class);
    }
}