<?php

namespace Tests\Feature\ProductBuy;


use Tests\DatabaseActiveTest;

abstract class ProductBuyTest extends DatabaseActiveTest
{

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'product-buys';
    }
}