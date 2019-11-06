<?php

namespace Omatech\LaravelPromoCodes\Contracts;


interface UpdateWhenConfirmed
{
    public function make(int $referralCodeId): void;
}