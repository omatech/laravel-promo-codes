<?php

namespace Omatech\LaravelPromoCodes\Models;

class PromoCode extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'type',
        'title',
        'pct_discount',
        'amount_discount',
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
    ];
}