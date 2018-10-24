<?php

namespace Tests\Feature\PaymentType;


use App\User;

class DestroyTest extends PaymentTypeTest
{
    public function test_unauthenticated_users_cannot_hit_the_destroy_endpoint()
    {
        $payment_type = $this->createPaymentType();

        $this->destroy($payment_type->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_destroy_payment_types()
    {
        $this->authenticated();
        $payment_type = $this->createPaymentType();

        $this->destroy($payment_type->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_cannot_destroy_payment_types()
    {
        $this->authenticatedAdmin();
        $payment_type = $this->createPaymentType();

        $this->destroy($payment_type->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_cannot_destroy_other_people_payment_types()
    {
        $payment_type = $this->createPaymentType();
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();

        $this->authenticated($user)
            ->destroy($payment_type->id)
            ->assertStatus(404)
            ->assertSeeText('No query results for model');
    }

    public function test_authenticated_users_with_client_can_destroy_its_own_payment_types()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();
        $payment_type = $this->createPaymentType([
            'client_id' => $user->client_id
        ]);

        $this->authenticated($user)
            ->destroy($payment_type->id)
            ->assertStatus(200)
            ->assertSeeText('');

        $this->assertSoftDeleted('payment_types', [
           'id' => $payment_type->id
        ]);
    }

    public function destroy($payment_typeId)
    {
        return $this->makeDeleteRequest(['destroy', $payment_typeId]);
    }
}