<?php

namespace App\Services;


use App\Scopes\ClientScope;

trait Clientable
{
    use BelongsToClient;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ClientScope());
    }
}