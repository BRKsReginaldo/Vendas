<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        'client_id' => function () {
            return create(\App\Client::class)->id;
        },
        'payment_type_id' => function ($payment) {
            return create(\App\PaymentType::class, [
                'client_id' => $payment['client_id']
            ])->id;
        },
        'original_price' => $faker->numberBetween(1, 100),
        'discount' => $faker->numberBetween(0, 100),
        'discount_percentage' => function($payment) {
            return $payment['discount'] >= $payment['original_price'];
        },
        'price' => function ($payment) {
            if ($payment['discount_percentage']) {
                return $payment['original_price'] - ($payment['original_price'] * ($payment['discount'] / 100));
            }
            return $payment['original_price'] - $payment['discount'];
        },
        'total_plots' => $faker->numberBetween(1, 5),
        'paid_plots' => function ($payment) use ($faker) {
            return $faker->numberBetween(0, $payment['total_plots']);
        },
        'pending_plots' => function ($payment) {
            return $payment['total_plots'] - $payment['paid_plots'];
        },
        'payed_at' => function ($payment) use ($faker) {
            if ($payment['pending_plots'] === 0) return $faker->dateTimeBetween('-30 days')->format('d-m-Y');
            return null;
        },
        'payable_type' => $faker->randomElement(['App\\ProductBuy']),
        'payable_id' => function ($payment) {
            return create($payment['payable_type'], [
                'client_id' => $payment['client_id'],
            ])->id;
        }
    ];
});
