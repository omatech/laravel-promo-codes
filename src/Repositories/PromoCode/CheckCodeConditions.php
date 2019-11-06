<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;
use Omatech\LaravelPromoCodes\Contracts\CheckCodeConditions as CheckCodeConditionsInterface;

class CheckCodeConditions extends PromoCodeRepository implements CheckCodeConditionsInterface
{
    /**
     * @param int $id
     * @throws \Throwable
     */
    public function make(PromoCode $code, int $authUserId): bool
    {  
        return $this->checkCodeConditions($code, $authUserId);
    }
}