<?php

namespace Tests\Feature\Provider;


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
}