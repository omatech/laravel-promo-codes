<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\FindPromoCodeByCode as FindPromoCodeByCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class FindPromoCodeByCode extends PromoCodeRepository implements FindPromoCodeByCodeInterface
{
    /**
     * @var PromoCodeInterface
     */
    private $promoCode;

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
     * @param string $code
     * @return null|PromoCode
     */
    public function make(string $code): ?PromoCode
    {
        $model = $this->model->where('code', $code)->first();

        if (is_null($model))
            return null;

        return $this->promoCode->fromArray($model->toArray());
    }
}