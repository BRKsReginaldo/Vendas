<?php

namespace App;

use App\Services\Clientable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use Clientable, SoftDeletes;

    protected $fillable = [
        'client_id',
        'original_price',
        'discount',
        'discount_percentage',
        'price',
        'payment_type_id',
        'total_plots',
        'pending_plots',
        'paid_plots',
        'payed_at',
        'payable_type',
        'payable_id',
    ];

    public function payable()
    {
        return $this->morphTo();
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
