<?php

namespace App;

use App\Services\Clientable;
use App\Services\Userable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use Clientable, Userable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'client_id',
        'customer_id',
        'panel_id',
        'total_price',
        'observations'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
