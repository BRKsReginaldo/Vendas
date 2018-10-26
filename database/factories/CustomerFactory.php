<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {

    return [
        'name' => $faker->firstName,
        'phone' => $faker->phoneNumber,
        'user_id' => function () {
            return create(\App\User::class)->id;
        },
        'client_id' => function (array $customer) {
            return \App\User::find($customer['user_id'])->createClient()->id;
        },
        'observations' => $faker->text(10000)
    ];
});
