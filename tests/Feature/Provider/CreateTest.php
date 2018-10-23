<?php

namespace Tests\Feature\Provider;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends ProviderTest
{
    public function test_unauthenticated_users_cannot_hit_the_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_are_not_allowed_to_create_providers()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
