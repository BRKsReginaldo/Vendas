<?php

namespace Tests\Feature\Customer;


use App\Client;
use App\User;

class RestoreTest extends CustomerTest
{
    public function test_unauthenticated_users_cannot_hit_the_restore_endpoint()
    {
        $original = $this->createCustomer();
        $customer = $original->toArray();
        $original->delete();
        $this->assertSoftDeleted('customers', [
            'id' => $customer['id']
        ]);

        $this->restore($customer['id'])
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');

        $this->assertSoftDeleted('customers', [
            'id' => $customer['id']
        ]);
    }

    public function test_authenticated_users_cannot_restore_other_people_customers()
    {
        $user = create(User::class);

        $original = $this->createCustomer();
        $customer = $original->toArray();
        $original->delete();
        $this->assertSoftDeleted('customers', [
            'id' => $customer['id']
        ]);

        $this
            ->authenticated($user)
            ->restore($customer['id'])
            ->assertStatus(403)
            ->assertSeeText('unauthorized');

        $this->assertSoftDeleted('customers', [
            'id' => $customer['id']
        ]);
    }

    public function test_authenticated_admins_users_cannot_restore_other_people_customers()
    {
        $original = $this->createCustomer();
        $customer = $original->toArray();
        $original->delete();
        $this->assertSoftDeleted('customers', [
            'id' => $customer['id']
        ]);

        $this
            ->authenticatedAdmin()
            ->restore($customer['id'])
            ->assertStatus(403)
            ->assertSeeText('unauthorized');

        $this->assertSoftDeleted('customers', [
            'id' => $customer['id']
        ]);
    }

    public function test_authenticated_users_can_restore_its_own_customers()
    {
        $original = $this->createCustomer();
        $customer = $original->toArray();
        $user = $original->user;
        $original->delete();

        $this->assertSoftDeleted('customers', [
            'id' => $customer['id']
        ]);

        $this
            ->authenticated($user)
            ->restore($customer['id'])
            ->assertStatus(200)
            ->assertSeeText('');

        $this->assertDatabaseHas('customers', [
            'id' => $customer['id'],
            'deleted_at' => null
        ]);
    }

    public function restore($customerId)
    {
        return $this->makePutRequest(['restore', $customerId]);
    }
}