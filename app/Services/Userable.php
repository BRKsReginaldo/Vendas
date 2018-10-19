<?php

namespace App\Services;


use App\User;

trait Userable
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}