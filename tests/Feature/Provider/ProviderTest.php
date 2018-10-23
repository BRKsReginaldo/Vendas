<?php

namespace Tests\Feature\Provider;


use App\Provider;
use Tests\DatabaseActiveTest;

abstract class ProviderTest extends DatabaseActiveTest
{

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'providers';
    }

    public function makeProvider($attributes = [], $times = null)
    {
        return make(Provider::class, $attributes, $times);
    }

    public function createProvider($attributes = [], $times = null)
    {
        return create(Provider::class, $attributes, $times);
    }
}