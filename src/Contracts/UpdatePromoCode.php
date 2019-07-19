<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface UpdatePromoCode
{
    public function make(int $id, PromoCode $data): void;
}