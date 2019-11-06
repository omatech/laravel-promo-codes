<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\GeneratePromoCode as GeneratePromoCodeInterface;
use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\Models\RelatedModel;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;
use Omatech\LaravelPromoCodes\Repositories\ReferralRepository;
use Omatech\LaravelPromoCodes\Traits\Codeable;

class GeneratePromoCode extends PromoCodeRepository implements GeneratePromoCodeInterface
{
    use Codeable;

    /**
     * @var FindPromoCodeByCode
     */
    private $findPromoCodeByCode;
    private $relatedModel;

    /**
     * GeneratePromoCode constructor.
     * @param PromoCodeInterface $promoCode
     * @param FindPromoCodeByCode $findPromoCodeByCode
     * @param RelatedModel $relatedModel
     * @throws \Exception
     */
    public function __construct(
        PromoCodeInterface $promoCode,
        FindPromoCodeByCode $findPromoCodeByCode,
        RelatedModel $relatedModel,
        ReferralRepository $referral
    )
    {
        parent::__construct($promoCode, $referral);
        $this->findPromoCodeByCode = $findPromoCodeByCode;
        $this->relatedModel = $relatedModel;
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

        if (isset($model->id) && isset($data['related_id']) && isset($data['related_type'])) {
            $this->relatedModel->create([
                'model_id' => $data['related_id'],
                'model_type' => $data['related_type'],
                'promo_code_id' => $model->id,
            ]);
        }

        return $this->promoCode->fromArray($model->toArray());
    }
}