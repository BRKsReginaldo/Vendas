<?php

namespace App;

use App\Services\Clientable;
use App\Services\Userable;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use Clientable, Userable;

    protected $fillable = [
      'client_id',
      'user_id',
      'name',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
