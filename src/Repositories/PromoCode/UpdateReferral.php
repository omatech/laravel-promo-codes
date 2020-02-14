<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Repositories\ReferralRepository;
use Omatech\LaravelPromoCodes\Contracts\UpdateReferral as UpdateReferralInterface;

class UpdateReferral extends ReferralRepository implements UpdateReferralInterface
{
    /**
     * @param int $id
     * @throws \Throwable
     */
    public function make(int $referralCodeId, int $promoUserId)
    {
        $this->updateReferral($referralCodeId, $promoUserId);
    }





}
