<?php

namespace Omatech\LaravelPromoCodes\Models;


use Illuminate\Database\Eloquent\Model;

class RelatedModel extends Model
{
    protected $table = 'model_promo_codes';

    protected $fillable = [
        'model_id',
        'model_type',
        'promo_code_id',
    ];
}