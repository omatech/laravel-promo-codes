<?php

namespace Omatech\LaravelPromoCodes\Repositories;

use Exception;
use Omatech\LaravelPromoCodes\Models\Referral;

class ReferralRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Referral::class;
    }

    public function createReferral($userId, $referralUserId, $codeId)
    {
        try {
            return $this->model()::create([
                'user_id'   => $userId,
                'user_referral_id'  => $referralUserId,
                'promo_code_id'     => $codeId, 
                'confirmed'         => 0,
                'used'              => 0
            ]);
        } catch (Exception $e) {
            \Log::info($e);
        }
    }

    public function deleteReferral($referralId){
        try {
            $this->model()::where('id', $referralId)->delete();
        } catch (Exception $e) {
            report($e);
        }
    }

    public function updatedWhenUsed($referralCodeId)
    {
        $this->model()::where('id',  $referralCodeId)->update(['used' => 1]);  
    }
    
    public function updateWhenConfirmed($referralCodeId)
    {
        $this->model()::where('id', $referralCodeId)->update(['confirmed' => 1]);  
    }
  

}