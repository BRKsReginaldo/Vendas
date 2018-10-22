<?php

namespace Tests\Feature\Customer;


use App\Client;
use App\Customer;
use App\User;

class UpdateTest extends CustomerTest
{
    public function test_unauthenticated_users_cannot_hit_the_update_endpoint()
    {
        $customer = create(Customer::class);

        $this->update($customer->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_cannot_update_other_users_customers()
    {
        $client = create(Client::class);
        $user = $client->customer;
        $customer = create(Customer::class);

        $this->authenticated($user)
            ->update($customer->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_can_update_itself_customers()
    {
        $customer = create(Customer::class);
        $user = $customer->user;

        $this->authenticated($user)
            ->update($customer->id, $customer->toArray())
            ->assertStatus(200)
            ->assertSeeText($customer['phone'])
            ->assertSeeText($customer['user_id'])
            ->assertSeeText($customer['client_id'])
            ->assertSeeText($customer['name']);
    }

    public function test_authenticated_users_can_update_itself_customers_and_database_updates_content_successfuly()
    {
        $customer = create(Customer::class);
        $user = $customer->user;
        $newData = [
            'name' => 'test name',
            'phone' => 'test phone',
            'user_id' => $user->id,
            'client_id' => $user->client_id
        ];

        $this->authenticated($user)
            ->update($customer->id, $newData)
            ->assertStatus(200)
            ->assertSeeText($newData['phone'])
            ->assertSeeText($newData['user_id'])
            ->assertSeeText($newData['client_id'])
            ->assertSeeText($newData['name']);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'name' => $newData['name'],
            'phone' => $newData['phone'],
            'client_id' => $newData['client_id'],
            'user_id' => $newData['user_id'],
        ]);
    }

    public function test_authenticated_users_can_update_itself_customers_and_validation_blocks_without_name()
    {
        $this->checkValidationFor('name');
    }

    public function test_authenticated_users_can_update_itself_customers_and_validation_blocks_without_phone()
    {
        $this->checkValidationFor('phone');
    }

    public function test_authenticated_users_can_update_itself_customers_and_validation_blocks_without_user_id()
    {
        $this->checkValidationFor('user_id');
    }

    public function test_authenticated_users_can_update_itself_customers_and_validation_blocks_without_client_id()
    {
        $this->checkValidationFor('client_id');
    }

    public function checkValidationFor($field)
    {
        $customer = create(Customer::class);
        $user = $customer->user;
        $newData = [
            'name' => 'test name',
            'phone' => 'test phone',
            'user_id' => $user->id,
            'client_id' => $user->client_id
        ];

        unset($newData[$field]);

        $this->authenticated($user)
            ->update($customer->id, $newData)
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    $field
                ]
            ]);

    }

    public function update($customerId, $data = [])
    {
        return $this->makePatchRequest(['update', $customerId], $data);
    }
}