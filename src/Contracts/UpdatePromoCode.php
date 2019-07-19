<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface UpdatePromoCode
{
    public function make(int $id, array $data): void;
}