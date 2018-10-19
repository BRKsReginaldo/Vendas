<?php

namespace App;

use App\Scopes\ClientScope;
use App\Services\Clientable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use Clientable, SoftDeletes;

    protected $fillable = [
        'name',
        'client_id'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
