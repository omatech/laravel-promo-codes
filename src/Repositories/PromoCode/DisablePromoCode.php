<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\DisablePromoCode as DisablePromoCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;

class DisablePromoCode extends PromoCodeRepository implements DisablePromoCodeInterface
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
     * @throws \Throwable
     */
    public function make(int $id): void
    {
        $isDisabled = $this->model->where('id', $id)->update([
            'active' => false
        ]);

        throw_if(!$isDisabled, \Exception::class);
    }
}