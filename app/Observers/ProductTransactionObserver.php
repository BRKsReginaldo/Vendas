<?php

namespace App\Observers;


use App\ProductTransaction;

class ProductTransactionObserver
{
    public function created(ProductTransaction $productTransaction)
    {
        $productTransaction->product()->update([
           'stock' => $productTransaction->new_stock
        ]);
    }
}