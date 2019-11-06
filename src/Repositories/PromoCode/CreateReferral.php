<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Repositories\ReferralRepository;
use Omatech\LaravelPromoCodes\Contracts\CreateReferral as CreateReferralInterface;

class CreateReferral extends ReferralRepository implements CreateReferralInterface
{
    /**
     * @param int $id
     * @throws \Throwable
     */
    public function make($code, $referralUser, $authUserId): ?int
    {
        $userId = $authUserId;
        $referralUserId = $referralUser;

        if(!is_null($code) && $userId !== $referralUserId){
            $referral = $this->createReferral($userId, $referralUserId, $code);
            return $referral->id;
        }
    }





}