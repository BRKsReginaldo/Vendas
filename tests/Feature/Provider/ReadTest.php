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

    public function test_authenticated_users_without_client_cannot_read_providers()
    {
        $this->authenticated()
            ->read()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_can_read_its_own_providers()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $providers = $this->createProvider([
            'client_id' => $client->id
        ], 3)->toArray();

        $this->authenticated($user)
            ->read()
            ->assertStatus(200)
            ->assertSeeText($providers[0]['name'])
            ->assertSeeText($providers[0]['client_id'])
            ->assertSeeText($providers[1]['name'])
            ->assertSeeText($providers[1]['client_id'])
            ->assertSeeText($providers[2]['name'])
            ->assertSeeText($providers[2]['client_id'])
            ->assertPaginationResource();
    }


    public function test_authenticated_users_with_client_can_read_only_own_providers()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $providers = $this->createProvider([
            'client_id' => $client->id
        ], 3)->toArray();
        $provider = $this->createProvider([
            'name' => 'some awesome name'
        ])->toArray();

        $this->authenticated($user)
            ->read()
            ->assertStatus(200)
            ->assertSeeText($providers[0]['name'])
            ->assertSeeText($providers[0]['client_id'])
            ->assertSeeText($providers[1]['name'])
            ->assertSeeText($providers[1]['client_id'])
            ->assertSeeText($providers[2]['name'])
            ->assertSeeText($providers[2]['client_id'])
            ->assertDontSeeText($provider['name'])
            ->assertPaginationResource();
    }

    public function test_pagination_only_shows_20_records()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $providers = $this->createProvider([
            'client_id' => $client->id
        ], 20)->toArray();

        $providers[] = $this->createProvider([
            'name' => 'awesome test name'
        ])->toArray();

        $response = $this->authenticated($user)
            ->read();

        $response
            ->assertStatus(200);

        for ($i = 0; $i < 20; $i++) {
            $response->assertSeeText($providers[$i]['name'])
                ->assertSeeText($providers[$i]['client_id']);
        }

        $response->assertDontSeeText($providers[20]['name']);
    }


    public function read()
    {
        return $this->makeGetRequest('index');
    }

}
