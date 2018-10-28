<?php

namespace Tests\Unit;

use App\Payment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    use DatabaseMigrations;

    public function test_payment_is_not_paid_until_all_plots_are_payed()
    {
        $payment = create(Payment::class, [
            'total_plots' => 5,
            'paid_plots' => 0
        ]);

        $this->assertFalse($payment->paid);

        $payment->update([
            'paid_plots' => 1
        ]);

        $this->assertFalse($payment->fresh()->paid);

        $payment->update([
            'paid_plots' => 2
        ]);

        $this->assertFalse($payment->fresh()->paid);

        $payment->update([
            'paid_plots' => 3
        ]);

        $this->assertFalse($payment->fresh()->paid);

        $payment->update([
            'paid_plots' => 4
        ]);

        $this->assertFalse($payment->fresh()->paid);

        $payment->update([
            'paid_plots' => 5
        ]);

        $this->assertTrue($payment->fresh()->paid);


    }
}
