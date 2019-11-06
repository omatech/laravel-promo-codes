<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface UpdateReferral
{
    public function make(int $referralCodeId, int $promoUserId);
}