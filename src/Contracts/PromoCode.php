<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface PromoCode
{
    public function find(int $id): ?self;
    public function findByCode(string $code): ?self;
    public function fromArray(array $data): ?self;
}