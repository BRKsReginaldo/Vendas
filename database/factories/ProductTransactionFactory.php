<?php

use Faker\Generator as Faker;

$factory->define(App\ProductTransaction::class, function (Faker $faker) {
    return [
        'client_id' => function () {
            return create(\App\Client::class)->id;
        },
        'user_id' => function ($productTransaction) {
            return \App\User::where('client_id', $productTransaction['client_id'])->first()->id;
        },
        'product_id' => function ($productTransaction) {
            return create(\App\Product::class, [
                'client_id' => $productTransaction['client_id'],
                'provider_id' => create(\App\Provider::class, [
                    'client_id' => $productTransaction['client_id']
                ])->id
            ])->id;
        },
        'old_stock' => function ($productTransaction) use ($faker) {
            return $faker->numberBetween(1, 50);
        },
        'new_stock' => function($productTransaction) {
            return ceil($productTransaction['old_stock'] * (rand(0, 200) / 100));
        }
    ];
});
