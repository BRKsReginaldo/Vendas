<?php

namespace Tests\Feature\Customer;


use App\Customer;
use Tests\DatabaseActiveTest;

abstract class CustomerTest extends DatabaseActiveTest
{

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'customers';
    }

    public function createCustomer($attributes = [], $times = null)
    {
        return create(Customer::class, $attributes, $times);
    }

    public function makeCustomer($attributes = [], $times = null)
    {
        return make(Customer::class, $attributes, $times);
    }
}