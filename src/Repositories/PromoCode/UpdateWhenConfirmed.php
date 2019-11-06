<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\UpdateWhenConfirmed as UpdateWhenConfirmedInterface;
use Omatech\LaravelPromoCodes\Repositories\ReferralRepository;

class UpdateWhenConfirmed extends ReferralRepository implements UpdateWhenConfirmedInterface
{
    /**
     * @param int $id
     * @throws \Throwable
     */
    public function make($referralCodeId): void
    {
        $this->updateWhenConfirmed($referralCodeId);
    }

}