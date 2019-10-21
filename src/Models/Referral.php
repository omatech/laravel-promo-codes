<?php

namespace Omatech\LaravelPromoCodes\Models;

class Referral extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "referrals";

    protected $fillable = ['user_id', 'user_referral_id', 'promo_code_id', 'confirmed', 'used', 'created_at', 'updated_at'];
}