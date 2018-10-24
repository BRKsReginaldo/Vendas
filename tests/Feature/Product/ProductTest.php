<?php

namespace Tests\Feature\Product;


use App\Product;
use Tests\DatabaseActiveTest;

abstract class ProductTest extends DatabaseActiveTest
{
    public function createProduct($attributes = [], $times = null)
    {
        return create(Product::class, $attributes, $times);
    }

    public function makeProduct($attributes = [], $times = null)
    {
        return make(Product::class, $attributes, $times);
    }

    /**
     *  Get the api resource for the test
     */
    function apiResource(): string
    {
        return 'products';
    }
}