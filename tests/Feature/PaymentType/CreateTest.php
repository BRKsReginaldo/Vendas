<?php

namespace Tests\Feature\PaymentType;

use App\PaymentType;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends PaymentTypeTest
{
    public function test_unauthenticated_users_cannot_hit_the_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_are_not_allowed_to_create_payment_types()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_without_client_are_not_allowed_to_create_payment_types()
    {
        $this->authenticatedAdmin()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_with_client_can_create_payment_types()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $payment_type = $this->makePaymentType([
            'client_id' => $client->id
        ])->toArray();

        $res = $this->authenticated($user)
            ->create($payment_type);

//        dd($res->getContent());

        $res
            ->assertStatus(201)
            ->assertSeeText($payment_type['name'])
            ->assertSeeText($payment_type['client_id'])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'client_id'
                ]
            ]);

        $this->assertDatabaseHas('payment_types', $payment_type);
        $this->assertCount(1, PaymentType::get());
    }

    public function test_validation_block_us_without_name()
    {
        $this->makeValidationFor('name');
    }

    public function test_validation_block_us_without_client_id()
    {
        $this->makeValidationFor('client_id');
    }

    public function makeValidationFor($field)
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $payment_type = $this->makePaymentType([
            'client_id' => $client->id
        ])->toArray();

        unset($payment_type[$field]);

        $this->authenticated($user)
            ->create($payment_type)
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    $field
                ]
            ]);

        $this->assertDatabaseMissing('payment_types', $payment_type);
        $this->assertCount(0, PaymentType::get());
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
