<?php

namespace Tests\Feature\Payment;


use App\Payment;
use Tests\DatabaseActiveTest;

abstract class PaymentTest extends DatabaseActiveTest
{
    public function createPayment($attributes = [], $times = null)
    {
        return create(Payment::class, $attributes, $times);
    }

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'payments';
    }
}