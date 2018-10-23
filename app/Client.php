<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'active'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}
