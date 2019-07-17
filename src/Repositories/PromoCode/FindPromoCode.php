<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Illuminate\Database\Eloquent\Model;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCode as FindPromoCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class FindPromoCode extends PromoCodeRepository implements FindPromoCodeInterface
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
     * @param int $id
     * @return Model|null
     */
    public function make(int $id): ?PromoCodeInterface
    {
        $model = $this->find($id);

        if (is_null($model))
            return null;

        return $this->promoCode->fromArray($model->toArray());
    }
}