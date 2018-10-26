<?php

namespace App\Observers;


use App\ProductBuy;

class ProductBuyObserver
{
    public function created(ProductBuy $productBuy)
    {
        $productBuy
            ->product
            ->makeTransaction($productBuy->product->stock + $productBuy->amount);
    }
}