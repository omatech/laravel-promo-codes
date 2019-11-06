<?php

namespace Omatech\LaravelPromoCodes\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = "referrals";

    protected $fillable = ['user_id', 'user_referral_id', 'promo_code_id', 'confirmed', 'used', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(config('laravel-promo-codes.user_referral_class'));
    }
}