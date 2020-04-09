<?php

namespace Omatech\LaravelPromoCodes\Repositories;

use Carbon\Carbon;
use Omatech\LaravelPromoCodes\Models\PromoCode;
use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;


class PromoCodeRepository extends BaseRepository
{
    /**
     * @var PromoCodeInterface
     */
    protected $promoCode;
    protected $referral;

    /**
     * FindPromoCode constructor.
     * @param PromoCodeInterface $promoCode
     * @throws \Exception
     */
    public function __construct(PromoCodeInterface $promoCode, ReferralRepository $referral)
    {
        parent::__construct();
        $this->promoCode = $promoCode;
        $this->referral = $referral;
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return PromoCode::class;
    }

    public function checkCodeConditions($code, $authUserId){
        $firstOrder = $code->getFirstOrderOnly();
        $oneUseOnly = $code->getOneUseOnly();
        $active = $code->isActive();
        $maxUses = $code->getMaxUses();
        $promoCodeUserId = $code->getUserId();
        $userId = $authUserId;
        $checkIds = false;

        if($promoCodeUserId == 0 || $promoCodeUserId == $userId){ $checkIds = true;}
        // dd($active, $maxUses, $checkIds);
        if($active == 1 && $maxUses > 0 && $checkIds){
            return true;
        }else{
            return false;
        }
    }

    public function updateIfPromoMember($codeId, $referralCodeId) : bool{
        try {
            $promoCode = $this->model()::where('id', $codeId);
            $promoCode->decrement('max_uses', 1);
            $promoCode = $promoCode->first();
            if($promoCode->max_uses == 0){ $this->model()::where('id', $codeId)->update(['active' => 0]); }
            $this->referral->updatedWhenUsed($referralCodeId);
            return true;
        } catch (\Exception $e) {
            \Log::error("Error Update If Promo Member");
            \Log::error($e->getMessage());
            return false;
        }
    }
}