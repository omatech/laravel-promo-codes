<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface FindPromoCodeByCode
{
    public function make(string $code): ?PromoCode;
}