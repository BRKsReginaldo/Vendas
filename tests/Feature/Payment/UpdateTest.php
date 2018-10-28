<?php

namespace Tests\Feature\Payment;


class UpdateTest extends PaymentTest
{
    public function test_unauthenticated_users_cannot_hit_the_update_test()
    {
        $payment = $this->createPayment();

        $this->update($payment->id)
            ->assertStatus(401)
            ->assertSeeText("Unauthenticated");
    }

    public function test_authenticated_users_without_client_cannot_hit_the_update_test()
    {
        $payment = $this->createPayment();

        $this->authenticated()
            ->update($payment->id)
            ->assertStatus(403)
            ->assertSeeText("unauthorized");

    }

    public function test_authenticated_users_with_client_can_update_their_own_payments()
    {
        $payment = $this->createPayment([
            'total_plots' => 5,
            'paid_plots' => 3
        ]);

        $newPayment = [
            'paid_plots' => 4,
            'pending_plots' => 1,
        ];

        $res = $this->authenticated($payment->client->creator)
            ->update($payment->id, $newPayment);

//        dd($res->getContent(), $payment, $newPayment);

        $res
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

        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'pending_plots' => $newPayment['pending_plots'],
            'paid_plots' => $newPayment['paid_plots'],
        ]);
    }

    public function update($paymentId, $data = [])
    {
        return $this->makePatchRequest(['update', $paymentId], $data);
    }
}