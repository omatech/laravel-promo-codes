<?php

use Faker\Generator as Faker;

$factory->define(\Omatech\LaravelPromoCodes\Models\RelatedModel::class, function (Faker $faker) {

    return [
        'model_id' => 1,
        'model_type' => 'App/User',
        'promo_code_id' => factory(\Omatech\LaravelPromoCodes\Models\PromoCode::class)->create()->id
    ];

});