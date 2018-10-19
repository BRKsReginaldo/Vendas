<?php

namespace App\Services;


use App\Client;

trait BelongsToClient
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}