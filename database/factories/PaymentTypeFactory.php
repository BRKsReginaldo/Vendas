<?php

use Faker\Generator as Faker;

$factory->define(App\PaymentType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'client_id' => function() {
            return create(\App\Client::class)->id;
        },
        'observations' => $faker->text(10000)
    ];
});
