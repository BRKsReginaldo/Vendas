<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'buy_price' => $faker->numberBetween(10, 50),
        'sell_price' => function ($product) {
            return $product['buy_price'] * 1.3;
        },
        'client_id' => function () {
            return create(\App\Client::class)->id;
        },
        'provider_id' => function ($product) {
            return create(\App\Provider::class, [
                'client_id' => $product['client_id']
            ])->id;
        }
    ];
});
