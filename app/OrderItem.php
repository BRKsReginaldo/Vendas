<?php

namespace App;

use App\Services\Clientable;
use App\Services\Payable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use Clientable, SoftDeletes, Payable;

    protected $fillable = [
        'client_id',
        'product_id',
        'observations',
        'product_transaction_id',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productTransaction()
    {
        return $this->belongsTo(ProductTransaction::class);
    }
}
