<?php

use Faker\Generator as Faker;

$factory->define(App\Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'client_id' => function() {
            return create(\App\Client::class)->id;
        }
    ];
});
