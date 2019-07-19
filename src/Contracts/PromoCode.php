<?php

namespace Omatech\LaravelPromoCodes\Contracts;

interface PromoCode
{
    public function disable(int $id): void;

    public static function find(int $id): ?self;

    public static function findAll(): array;

    public static function findByCode(string $code): ?self;

    public function fromArray(array $data): ?self;

    public function update(int $id, array $data): void;
}