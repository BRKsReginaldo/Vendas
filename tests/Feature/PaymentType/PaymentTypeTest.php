<?php

namespace Tests\Feature\PaymentType;


use App\PaymentType;
use Tests\DatabaseActiveTest;

abstract class PaymentTypeTest extends DatabaseActiveTest
{

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'payment-types';
    }

    public function makePaymentType($attributes = [], $times = null)
    {
        return make(PaymentType::class, $attributes, $times);
    }

    public function createPaymentType($attributes = [], $times = null)
    {
        return create(PaymentType::class, $attributes, $times);
    }
}