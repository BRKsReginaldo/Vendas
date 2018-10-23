<?php

namespace Tests\Feature\Provider;


use App\User;

class RestoreTest extends ProviderTest
{
    public function test_unauthenticated_users_cannot_hit_the_restore_endpoint()
    {
        $provider = $this->createProvider();
        $provider->delete();

        $this->restore($provider->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');

        $this->assertSoftDeleted('providers', [
            'id' => $provider->id
        ]);
    }

    public function test_authenticated_users_cannot_restore_other_people_providers()
    {
        $provider = $this->createProvider();
        $provider->delete();

        $this->authenticated()
            ->restore($provider->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');

        $this->assertSoftDeleted('providers', [
            'id' => $provider->id
        ]);
    }

    public function test_authenticated_users_can_restore_its_own_providers()
    {
        $user = create(User::class);
        $user->createClient();
        $user = $user->fresh();
        $provider = $this->createProvider([
            'client_id' => $user->client_id
        ]);

        $provider->delete();

        $this->assertSoftDeleted('providers', [
            'id' => $provider->id
        ]);

        $this->authenticated($user)
            ->restore($provider->id)
            ->assertStatus(200)
            ->assertSeeText($provider->name)
            ->assertJsonStructure([
               'data' => [
                   'id',
                   'name',
                   'client_id'
               ]
            ]);

        $this->assertDatabaseHas('providers', [
            'id' => $provider->id,
            'deleted_at' => null
        ]);
    }

    public function restore($providerId)
    {
        return $this->makePatchRequest(['restore', $providerId]);
    }
}