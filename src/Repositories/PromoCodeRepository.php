<?php

namespace Omatech\LaravelPromoCodes\Repositories;

use Omatech\LaravelPromoCodes\Models\PromoCode;

class PromoCodeRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function model()
    {
        return PromoCode::class;
    }
}