<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\GeneratePromoCode as GeneratePromoCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;
use Omatech\LaravelPromoCodes\Traits\Codeable;

class GeneratePromoCode extends PromoCodeRepository implements GeneratePromoCodeInterface
{
    use Codeable;

    /**
     * @var FindPromoCodeByCode
     */
    private $findPromoCodeByCode;

    /**
     * GeneratePromoCode constructor.
     * @param PromoCodeInterface $promoCode
     * @param FindPromoCodeByCode $findPromoCodeByCode
     * @throws \Exception
     */
    public function __construct(PromoCodeInterface $promoCode, FindPromoCodeByCode $findPromoCodeByCode)
    {
        parent::__construct($promoCode);
        $this->findPromoCodeByCode = $findPromoCodeByCode;
    }

    /**
     * @param array $data
     * @return PromoCodeInterface
     * @throws \Throwable
     */
    public function make(array $data): PromoCodeInterface
    {
        if (!isset($data['code']) || empty($data['code'])) {

            $prefix = $data['prefix'] ?? null;
            $data['code'] = $prefix . $this->generateCode();

        } else {
            $exists = $this->checkIfCodeExists($data['code']);

            throw_if($exists, \Exception::class);
        }

        $model = $this->model->create($data);

        return $this->promoCode->fromArray($model->toArray());
    }
}