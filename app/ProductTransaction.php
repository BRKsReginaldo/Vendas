<?php

namespace App;

use App\Services\Clientable;
use App\Services\Userable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTransaction extends Model
{
    use Clientable, Userable, SoftDeletes;

    protected $fillable = [
        'client_id',
        'user_id',
        'new_stock',
        'old_stock',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function productBuys()
    {
        return $this->hasMany(Product::class);
    }
}
