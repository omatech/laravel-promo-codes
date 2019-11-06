<?php

namespace Omatech\LaravelPromoCodes\Contracts;


interface CreateReferral
{
    public function make(int $codeId, int $referralUserId, int $authUserId): ?int;
}