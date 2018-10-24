<?php

namespace Tests\Feature\PaymentType;


use App\User;

class RestoreTest extends PaymentTypeTest
{
    public function test_unauthenticated_users_cannot_hit_the_restore_endpoint()
    {
        $payment_type = $this->createPaymentType();
        $payment_type->delete();

        $this->restore($payment_type->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');

        $this->assertSoftDeleted('payment_types', [
            'id' => $payment_type->id
        ]);
    }

    public function test_authenticated_users_cannot_restore_other_people_payment_types()
    {
        $payment_type = $this->createPaymentType();
        $payment_type->delete();

        $this->authenticated()
            ->restore($payment_type->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');

        $this->assertSoftDeleted('payment_types', [
            'id' => $payment_type->id
        ]);
    }

    public function test_authenticated_users_can_restore_its_own_payment_types()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();
        $payment_type = $this->createPaymentType([
            'client_id' => $user->client_id
        ]);

        $payment_type->delete();

        $this->assertSoftDeleted('payment_types', [
            'id' => $payment_type->id
        ]);

        $this->authenticated($user)
            ->restore($payment_type->id)
            ->assertStatus(200)
            ->assertSeeText($payment_type->name)
            ->assertJsonStructure([
               'data' => [
                   'id',
                   'name',
                   'client_id'
               ]
            ]);

        $this->assertDatabaseHas('payment_types', [
            'id' => $payment_type->id,
            'deleted_at' => null
        ]);
    }

    public function restore($payment_typeId)
    {
        return $this->makePatchRequest(['restore', $payment_typeId]);
    }
}