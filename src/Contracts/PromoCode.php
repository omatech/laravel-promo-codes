<?php

namespace Omatech\LaravelPromoCodes\Contracts;


interface PromoCode
{
    public function disable(): void;

    public static function find(int $id): ?self;

    public static function findAll(): array;

    public static function findByCode(string $code): ?self;

    public function fromArray(array $data): ?self;

    public function update(): void;

    public function checkCodeConditions(int $authUserId): bool;

    public function updateIfPromoMember(int $codeId, int $referralCodeId): bool;
    
    // public function createReferral(int $code, int $referralUser, int $authUserId): int;

    // public function updateReferral(int $referralId, int $promoUserId): void;

    // public function promoCodeConstructWhenReferral(int $promoUserId): array;



}