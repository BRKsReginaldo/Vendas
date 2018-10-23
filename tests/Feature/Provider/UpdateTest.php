<?php

namespace Tests\Feature\Provider;


use App\User;

class UpdateTest extends ProviderTest
{
    public function test_unauthenticated_users_cannot_hit_the_update_endpoint()
    {
        $provider = $this->createProvider();

        $this->update($provider->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_are_not_allowed_to_update_providers()
    {
        $provider = $this->createProvider();

        $this->authenticated()
            ->update($provider->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_are_not_allowed_to_update_providers()
    {
        $provider = $this->createProvider();

        $this->authenticatedAdmin()
            ->update($provider->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_cannot_update_other_people_providers()
    {
        $provider = $this->createProvider();
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();

        $this->assertDatabaseHas('providers', $provider->toArray());

        $this->authenticated($user)
            ->update($provider, [
                'client_id' => $user->client_id,
                'name' => 'test name'
            ])
            ->assertStatus(404)
            ->assertSeeText('No query results for model');
    }

    public function test_authenticated_users_can_update_its_own_providers()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();
        $provider = $this->createProvider([
            'client_id' => $user->client_id
        ]);
        $newProvider = [
            'name' => 'test name',
            'client_id' => $provider->client_id
        ];

        $this->authenticated($user)
            ->update($provider->id, $newProvider)
            ->assertStatus(200)
            ->assertSeeText($newProvider['name'])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'client_id'
                ]
            ]);

        $this->assertDatabaseHas('providers', [
           'id' => $provider->id,
           'name' => $newProvider['name'],
           'client_id' => $newProvider['client_id']
        ]);
    }

    public function update($providerId, $data = [])
    {
        return $this->makePatchRequest(['update', $providerId], $data);
    }
}