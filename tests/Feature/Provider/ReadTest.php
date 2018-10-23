<?php

namespace Tests\Feature\Provider;

use App\Provider;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadTest extends ProviderTest
{
    public function test_unauthenticated_users_cannot_hit_the_read_endpoint()
    {
        $this->read()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function read()
    {
        return $this->makeGetRequest('index');
    }

}
