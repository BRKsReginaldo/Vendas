<?php

namespace Tests\Feature\Customer;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadTest extends CustomerTest
{
    public function test_unauthenticated_users_cannot_hit_the_read_endpoint()
    {
        $this->read()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_read_customers()
    {
        $this->authenticated()
            ->read()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_without_client_cannot_read_customers()
    {
        $this->authenticatedAdmin()
            ->read()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_can_read_customers()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();

        $customers = $this->createCustomer([
            'user_id' => $user->id,
            'client_id' => $user->client_id
        ], 3)->toArray();

        $this->authenticated($user)
            ->read()
            ->assertStatus(200)
            ->assertSeeText($customers[0]['name'])
            ->assertSeeText($customers[0]['phone'])
            ->assertSeeText($customers[1]['name'])
            ->assertSeeText($customers[1]['phone'])
            ->assertSeeText($customers[2]['name'])
            ->assertSeeText($customers[2]['phone'])
            ->assertPaginationResource();

    }

    public function read()
    {
        return $this->makeGetRequest('index');
    }
}
