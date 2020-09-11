<?php

namespace Omatech\LaravelPromoCodes\Repositories\PromoCode;

use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Contracts\UpdatePromoCode as UpdatePromoCodeInterface;
use Omatech\LaravelPromoCodes\Models\RelatedModel;
use Omatech\LaravelPromoCodes\Repositories\PromoCodeRepository;
use Omatech\LaravelPromoCodes\Repositories\ReferralRepository;

class UpdatePromoCode extends PromoCodeRepository implements UpdatePromoCodeInterface
{

    private $updatableFields = [
        'type',
        'title',
        'pct_discount',
        'amount_discount',
        'amount_discount_by_total_price',
        'pct_shipping_discount',
        'max_uses',
        'start_date',
        'end_date',
        'first_order_only',
        'one_use_only',
        'customer_one_use_only',
        'action',
        'active',
        'last_order_days',

    ];
    /**
     * @var RelatedModel
     */
    private $relatedModel;

    public function __construct(
        PromoCode $promoCode,
        ReferralRepository $referral,
        RelatedModel $relatedModel
    )
    {
        parent::__construct($promoCode, $referral);
        $this->relatedModel = $relatedModel;
    }

    /**
     * @param int $id
     * @param PromoCode $promoCode
     */
    public function make(int $id, PromoCode $promoCode): void
    {
        $data = $promoCode->toArray();

        foreach ($data as $key => $datum) {
            if (!in_array($key, $this->updatableFields)) {
                unset($data[$key]);
            }
        }

        $this->model->where('id', $id)->update($data);

        $relatedType = $promoCode->getRelatedType();
        $related = $promoCode->getRelated();

        $updateRelated = isset($related) && isset($relatedType);

        if($updateRelated) {
            $this->relatedModel->where('promo_code_id', $id)->delete();

            foreach ($related as $relatedId){
                $this->relatedModel->create([
                    'model_id' => $relatedId,
                    'model_type' => $relatedType,
                    'promo_code_id' => $id,
                ]);
            }
        }
    }
}