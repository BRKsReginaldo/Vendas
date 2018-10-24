<?php

namespace App;

use App\Services\Clientable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use Clientable, SoftDeletes;

    protected $fillable = [
        'client_id',
        'name',
        'observations'
    ];
}
