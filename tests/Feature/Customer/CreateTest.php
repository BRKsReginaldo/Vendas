<?php

namespace Tests\Feature\Customer;

use App\Customer;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends CustomerTest
{
    public function test_unauthenticated_users_cannot_hit_the_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_users_without_client_are_not_allowed_to_create_clients()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_without_client_are_not_allowed_to_create_clients()
    {
        $this->authenticatedAdmin()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_are_allowed_to_hit_the_create_endpoint_and_validation_works()
    {
        $user = create(User::class);
        $user->createClient();

        $this->authenticated($user->fresh())
            ->create()
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'name',
                    'phone',
                    'client_id',
                    'user_id'
                ]
            ]);
    }

    public function test_authenticated_users_with_client_can_create_customers()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();

        $customer = $this->makeCustomer([
            'client_id' => $user->client_id,
            'user_id' => $user->id
        ])->toArray();

        $this->authenticated($user)
            ->create($customer)
            ->assertStatus(201)
            ->assertSeeText($customer['name'])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'phone',
                    'client_id',
                ]
            ]);

        $this->assertCount(1, Customer::get());
        $this->assertDatabaseHas('customers', $customer);
    }

    public function test_authenticated_users_with_client_cannot_create_customers_without_name()
    {
        $this->makeTestWithMissingField('name');
    }

    public function test_authenticated_users_with_client_cannot_create_customers_without_phone()
    {
        $this->makeTestWithMissingField('phone');
    }

    public function test_authenticated_users_with_client_cannot_create_customers_without_user_id()
    {
        $this->makeTestWithMissingField('user_id');
    }

    public function test_authenticated_users_with_client_cannot_create_customers_without_client_id()
    {
        $this->makeTestWithMissingField('client_id');
    }

    public function makeTestWithMissingField($field)
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();

        $customer = $this->makeCustomer([
            'client_id' => $user->client_id,
            'user_id' => $user->id
        ])->toArray();

        unset($customer[$field]);

        $this->authenticated($user)
            ->create($customer)
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    $field
                ]
            ]);

        $this->assertCount(0, Customer::get());
        $this->assertDatabaseMissing('customers', $customer);
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
