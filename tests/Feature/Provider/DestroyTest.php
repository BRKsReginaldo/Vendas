<?php

namespace Tests\Feature\Provider;


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

    public function destroy($providerId)
    {
        return $this->makeDeleteRequest(['destroy', $providerId]);
    }
}