<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Repositories\ReferralRepository;
use Omatech\LaravelPromoCodes\Contracts\DeleteReferral as DeleteReferralInterface;

class DeleteReferral extends ReferralRepository implements DeleteReferralInterface
{
    /**
     * @param int $id
     * @throws \Throwable
     */
    public function make($referralId): void
    {
        $this->deleteReferral($referralId);
    }

}