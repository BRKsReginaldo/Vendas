<?php

namespace App\Observers;


use App\Payment;

class PaymentObserver
{
    public function updating(Payment $payment)
    {
        if ($payment->total_plots == $payment->paid_plots && is_null($payment->payed_at)) {
            $payment->setAttribute('payed_at', now()->format('d-m-Y'));
        }
    }
}