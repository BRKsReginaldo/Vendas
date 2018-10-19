<?php

namespace App;

use App\Services\Clientable;
use App\Services\Payable;
use App\Services\Userable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBuy extends Model
{
    use Userable, Clientable, SoftDeletes, Payable;

    protected $fillable = [
        'product_id',
        'observations',
        'client_id',
        'user_id',
        'product_transaction_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productTransaction()
    {
        return $this->belongsTo(ProductTransaction::class);
    }
}
