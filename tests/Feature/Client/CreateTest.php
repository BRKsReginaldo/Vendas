<?php

namespace Tests\Feature\Client;


use App\User;

class CreateTest extends ClientTest
{
    public function test_unauthenticated_users_cannot_hit_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_are_not_allowed_to_create_clients()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_are_allowed_to_create_clients()
    {
        $this->authenticatedAdmin();
        $user = create(User::class);

        $this->assertNull($user->client_id);

        $response = $this->create(['user_id' => $user->id]);

        $response
            ->assertStatus(201)
            ->assertSeeText($user->id);

        $this->assertNotNull($user->fresh()->client_id);
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}