<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface UpdateIfPromoMember
{
    public function make(int $referralCodeId, int $promoUserId): bool;
}