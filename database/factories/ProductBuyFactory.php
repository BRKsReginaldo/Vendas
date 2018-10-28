<?php

use Faker\Generator as Faker;

$factory->define(App\ProductBuy::class, function (Faker $faker) {
    return [
        'client_id' => function () {
            return create(\App\Client::class)->id;
        },
        'product_id' => function ($productBuy) {
            return create(\App\Product::class, [
                'client_id' => $productBuy['client_id'],
                'provider_id' => create(\App\Provider::class, [
                    'client_id' => $productBuy['client_id']
                ])->id
            ])->id;
        },
        'user_id' => function ($productBuy) {
            return \App\Client::find($productBuy['client_id'])->creator->id;
        },
        'amount' => $faker->numberBetween(1, 10),
    ];
});
