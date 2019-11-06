<?php

namespace Omatech\LaravelPromoCodes\Contracts;

use Omatech\LaravelPromoCodes\Contracts\PromoCode;

interface CheckCodeConditions
{
    public function make(PromoCode $code, int $authUserId): bool;
}