<?php

namespace Tests\Feature\Provider;


use App\User;

class DestroyTest extends ProviderTest
{
    public function test_unauthenticated_users_cannot_hit_the_destroy_endpoint()
    {
        $provider = $this->createProvider();

        $this->destroy($provider->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_destroy_providers()
    {
        $this->authenticated();
        $provider = $this->createProvider();

        $this->destroy($provider->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_cannot_destroy_providers()
    {
        $this->authenticatedAdmin();
        $provider = $this->createProvider();

        $this->destroy($provider->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_cannot_destroy_other_people_providers()
    {
        $provider = $this->createProvider();
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();

        $this->authenticated($user)
            ->destroy($provider->id)
            ->assertStatus(404)
            ->assertSeeText('No query results for model');
    }

    public function test_authenticated_users_with_client_can_destroy_its_own_providers()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();
        $provider = $this->createProvider([
            'client_id' => $user->client_id
        ]);

        $this->authenticated($user)
            ->destroy($provider->id)
            ->assertStatus(200)
            ->assertSeeText('');

        $this->assertSoftDeleted('providers', [
           'id' => $provider->id
        ]);
    }

    public function destroy($providerId)
    {
        return $this->makeDeleteRequest(['destroy', $providerId]);
    }
}