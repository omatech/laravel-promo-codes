<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface GeneratePromoCode
{
    public function make(array $data): PromoCode;
}