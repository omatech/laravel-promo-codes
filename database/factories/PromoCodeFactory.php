<?php

use Faker\Generator as Faker;
use Omatech\LaravelPromoCodes\Models\PromoCode;

$factory->define(PromoCode::class, function (Faker $faker) {

    return [
        'user_id' => 0,
        'type' => $faker->word,
        'title' => $faker->text(45),
        'pct_discount' => $faker->randomFloat(2, 0, 100),
        'amount_discount' => $faker->randomFloat(2, 0, 20),
        'pct_shipping_discount' => $faker->randomFloat(2, 0, 100),
        'max_uses' => $faker->randomNumber(),
        'start_date' => $faker->dateTimeBetween('-10 days'),
        'end_date' => $faker->dateTimeBetween('now', '+10 days'),
        'first_order_only' => false,
        'one_use_only' => false,
        'customer_one_use_only' => false,
        'active' => true,
        'code' => $faker->word.$faker->randomNumber(5),
        'action' => $faker->text(),
    ];

});

$factory->state(PromoCode::class, 'expired', function (Faker $faker){

    return [
        'start_date' => $faker->dateTimeBetween('-10 days', "-8 days"),
        'end_date' => $faker->dateTimeBetween('-2 days', '-1 days'),
    ];

});

$factory->state(PromoCode::class, 'not-started', function (Faker $faker){

    return [
        'start_date' => $faker->dateTimeBetween('+1 days', "+2 days"),
        'end_date' => $faker->dateTimeBetween('+3 days', '+10 days'),
    ];

});