<?php

namespace App\Services;


use App\Payment;

trait Payable
{
    public function payment()
    {
        return $this->morphOne(Payment::class, 'payable');
    }
}