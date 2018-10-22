<?php

namespace Tests\Feature\Customer;


use App\Client;
use App\User;

class DestroyTest extends CustomerTest
{
    public function test_unauthenticated_users_cannot_hit_the_destroy_endpoint()
    {
        $customer = $this->createCustomer();

        $this->destroy($customer->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_cannot_destroy_other_people_customers()
    {
        $customer = $this->createCustomer();
        $user = create(User::class);

        $this
            ->authenticated($user)
            ->destroy($customer->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_users_cannot_destroy_other_people_customers()
    {
        $customer = $this->createCustomer();

        $this
            ->authenticatedAdmin()
            ->destroy($customer->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_can_destroy_its_own_customers()
    {
        $customer = $this->createCustomer();

        $this
            ->authenticated($customer->user)
            ->destroy($customer->id)
            ->assertStatus(200)
            ->assertSeeText('');

        $this->assertSoftDeleted('customers', [
            'id' => $customer->id
        ]);
    }

    public function destroy($customerId)
    {
        return $this->makeDeleteRequest(['destroy', $customerId]);
    }
}