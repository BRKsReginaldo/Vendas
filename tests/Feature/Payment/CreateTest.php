<?php

namespace Tests\Feature\Payment;

use App\Client;
use App\Payment;
use App\PaymentType;
use App\Product;
use App\ProductBuy;
use App\Provider;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends PaymentTest
{
    public function test_unauthenticated_users_cannot_hit_the_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSeeText("Unauthenticated");
    }

    public function test_authenticated_users_without_client_cannot_create_payments()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText("unauthorized");
    }

    public function test_authenticated_users_can_create_payments()
    {
        $productBuy = create(ProductBuy::class);
        $user = $productBuy->user;
        $paymentType = create(PaymentType::class, [
            'client_id' => $productBuy->client->id
        ]);
        $payment = make(Payment::class, [
            'client_id' => $productBuy->client->id,
            'payment_type_id' => $paymentType->id,
            'payable_type' => $productBuy->getMorphClass(),
            'payable_id' => $productBuy->id
        ])->toArray();

        $this->authenticated($user)
            ->create($payment)
            ->assertStatus(201)
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
                    'payable_id'
                ]
            ]);

        $this->assertDatabaseHas('payments', $payment);
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
