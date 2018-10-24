<?php

namespace Tests\Feature\PaymentType;


use App\User;

class UpdateTest extends PaymentTypeTest
{
    public function test_unauthenticated_users_cannot_hit_the_update_endpoint()
    {
        $payment_type = $this->createPaymentType();

        $this->update($payment_type->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_are_not_allowed_to_update_payment_types()
    {
        $payment_type = $this->createPaymentType();

        $this->authenticated()
            ->update($payment_type->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_are_not_allowed_to_update_payment_types()
    {
        $payment_type = $this->createPaymentType();

        $this->authenticatedAdmin()
            ->update($payment_type->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_cannot_update_other_people_payment_types()
    {
        $payment_type = $this->createPaymentType();
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();

        $this->assertDatabaseHas('payment_types', $payment_type->toArray());

        $this->authenticated($user)
            ->update($payment_type, [
                'client_id' => $user->client_id,
                'name' => 'test name'
            ])
            ->assertStatus(404)
            ->assertSeeText('No query results for model');
    }

    public function test_authenticated_users_can_update_its_own_payment_types()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();
        $payment_type = $this->createPaymentType([
            'client_id' => $user->client_id
        ]);
        $newPaymentType = [
            'name' => 'test name',
            'client_id' => $payment_type->client_id
        ];

        $this->authenticated($user)
            ->update($payment_type->id, $newPaymentType)
            ->assertStatus(200)
            ->assertSeeText($newPaymentType['name'])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'client_id'
                ]
            ]);

        $this->assertDatabaseHas('payment_types', [
           'id' => $payment_type->id,
           'name' => $newPaymentType['name'],
           'client_id' => $newPaymentType['client_id']
        ]);
    }

    public function update($payment_typeId, $data = [])
    {
        return $this->makePatchRequest(['update', $payment_typeId], $data);
    }
}