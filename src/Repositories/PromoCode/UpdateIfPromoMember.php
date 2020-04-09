<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\UpdateIfPromoMember as UpdateIfPromoMemberInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class UpdateIfPromoMember extends PromoCodeRepository implements UpdateIfPromoMemberInterface
{
    /**
     * @param int $id
     * @throws \Throwable
     */
    public function make($codeId, $referralCodeId): bool
    {
        return $this->updateIfPromoMember($codeId, $referralCodeId);
    }

}