<?php

namespace Omatech\LaravelPromoCodes\Models;

use \Illuminate\Database\Eloquent\Model;
use Omatech\LaravelPromoCodes\Models\Referral;

class PromoCode extends Model
{
    protected $table = "promo_codes";

    protected $fillable = [
        'user_id',
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
        'active',
        'code',
        'action',
        'its_a_referral',
        'last_order_days',
    ];


    // public function user(){
    //     return $this->belongsTo(User::class, 'id', 'personal_code_id');
    // }


    public function user(){
        return $this->belongsTo(config('promo-codes.options.users.model'), 'id', 'personal_code_id');
    }

    public function referral(){
        return $this->hasOne(Referral::class, 'user_referral_id', 'user_id');
    }

    public function related()
    {
        return $this->hasMany(RelatedModel::class);
    }
}