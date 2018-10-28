<?php

namespace Tests\Feature\Payment;

use App\Payment;

class ShowTest extends PaymentTest
{
    public function test_unauthenticated_cannot_hit_the_show_endpoint()
    {
        $payment = create(Payment::class);

        $this->show($payment->id)
            ->assertStatus(401)
            ->assertSeeText("Unauthenticated");
    }

    public function test_authenticated_users_without_client_cannot_hit_the_show_endpoint()
    {
        $payment = create(Payment::class);

        $this->authenticated()
            ->show($payment->id)
            ->assertStatus(403)
            ->assertSeeText("unauthorized");
    }

    public function test_authenticated_users_can_view_its_own_payments()
    {
        $payment = create(Payment::class);

        $this->authenticated($payment->client->creator)
            ->show($payment->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'client_id',
                    'original_price',
                    'price',
                    'discount',
                    'discount_percentage',
                    'payment_type_id',
                    'total_plots',
                    'pending_plots',
                    'paid_plots',
                    'payed_at',
                    'paid',
                    'payable_type',
                    'payable_id',
                ]
            ]);
    }

    public function show($paymentId)
    {
        return $this->makeGetRequest(['show', $paymentId]);
    }
}
