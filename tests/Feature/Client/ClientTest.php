<?php

namespace Tests\Feature\Client;


use Tests\DatabaseActiveTest;

abstract class ClientTest extends DatabaseActiveTest
{

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'clients';
    }
}