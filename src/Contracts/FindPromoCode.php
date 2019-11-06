<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface FindPromoCode
{
    public function make(int $id): ?PromoCode;
}