<?php

namespace Omatech\LaravelPromoCodes\Contracts;


interface DeleteReferral
{
    public function make(int $referralId): void;
}