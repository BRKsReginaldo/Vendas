<?php

namespace App;

use App\Services\Clientable;
use App\Services\Userable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use Clientable, Userable, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'client_id',
        'user_id',
        'observations'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
