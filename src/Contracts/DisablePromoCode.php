<?php

namespace Omatech\LaravelPromoCodes\Contracts;


interface DisablePromoCode
{
    public function make(int $id): void;
}