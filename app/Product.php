<?php

namespace App;

use App\Services\Clientable;
use App\Services\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Clientable, Imageable, SoftDeletes;

    protected $fillable = [
        'provider_id',
        'client_id',
        'name',
        'description',
        'buy_price',
        'sell_price',
        'stock',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function transactions()
    {
        return $this->hasMany(ProductTransaction::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function productBuys()
    {
        return $this->hasMany(ProductBuy::class);
    }

    function defaultImage()
    {
        return 'product.png';
    }

    public function makeTransaction($newStock)
    {
        return $this->transactions()
            ->create([
               'old_stock' => $this->attributes['stock'],
               'client_id' => $this->attributes['client_id'],
               'user_id' => auth()->check() ? auth()->id() : $this->client->creator()->first(['user_id'])->user_id,
               'new_stock' => $newStock
            ]);
    }
}
