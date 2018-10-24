<?php

namespace Tests\Feature\PaymentType;

use App\PaymentType;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadTest extends PaymentTypeTest
{
    public function test_unauthenticated_users_cannot_hit_the_read_endpoint()
    {
        $this->read()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_read_payment_types()
    {
        $this->authenticated()
            ->read()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_can_read_its_own_payment_types()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $payment_types = $this->createPaymentType([
            'client_id' => $client->id
        ], 3)->toArray();

        $this->authenticated($user)
            ->read()
            ->assertStatus(200)
            ->assertSeeText($payment_types[0]['name'])
            ->assertSeeText($payment_types[0]['client_id'])
            ->assertSeeText($payment_types[1]['name'])
            ->assertSeeText($payment_types[1]['client_id'])
            ->assertSeeText($payment_types[2]['name'])
            ->assertSeeText($payment_types[2]['client_id'])
            ->assertPaginationResource();
    }


    public function test_authenticated_users_with_client_can_read_only_own_payment_types()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $payment_types = $this->createPaymentType([
            'client_id' => $client->id
        ], 3)->toArray();
        $payment_type = $this->createPaymentType([
            'name' => 'some awesome name'
        ])->toArray();

        $this->authenticated($user)
            ->read()
            ->assertStatus(200)
            ->assertSeeText($payment_types[0]['name'])
            ->assertSeeText($payment_types[0]['client_id'])
            ->assertSeeText($payment_types[1]['name'])
            ->assertSeeText($payment_types[1]['client_id'])
            ->assertSeeText($payment_types[2]['name'])
            ->assertSeeText($payment_types[2]['client_id'])
            ->assertDontSeeText($payment_type['name'])
            ->assertPaginationResource();
    }

    public function test_pagination_only_shows_20_records()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $payment_types = $this->createPaymentType([
            'client_id' => $client->id
        ], 20)->toArray();

        $payment_types[] = $this->createPaymentType([
            'name' => 'awesome test name'
        ])->toArray();

        $response = $this->authenticated($user)
            ->read();

        $response
            ->assertStatus(200);

        for ($i = 0; $i < 20; $i++) {
            $response->assertSeeText($payment_types[$i]['name'])
                ->assertSeeText($payment_types[$i]['client_id']);
        }

        $response->assertDontSeeText($payment_types[20]['name']);
    }


    public function read()
    {
        return $this->makeGetRequest('index');
    }

}
