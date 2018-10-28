<?php

namespace App\Observers;


use App\ProductBuy;

class ProductBuyObserver
{
    public function created(ProductBuy $productBuy)
    {
        $transaction = $productBuy
            ->product
            ->makeTransaction($productBuy->product->stock + $productBuy->amount);

        $productBuy->update([
            'product_transaction_id' => $transaction->id
        ]);
    }
}