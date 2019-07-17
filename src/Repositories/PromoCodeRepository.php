<?php

namespace Omatech\LaravelPromoCodes\Repositories;

use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\Models\PromoCode;

class PromoCodeRepository extends BaseRepository
{
    /**
     * @var PromoCodeInterface
     */
    protected $promoCode;

    /**
     * FindPromoCode constructor.
     * @param PromoCodeInterface $promoCode
     * @throws \Exception
     */
    public function __construct(PromoCodeInterface $promoCode)
    {
        parent::__construct();
        $this->promoCode = $promoCode;
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return PromoCode::class;
    }
}