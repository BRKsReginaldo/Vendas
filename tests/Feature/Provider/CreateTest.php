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

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
