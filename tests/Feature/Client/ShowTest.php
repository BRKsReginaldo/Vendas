<?php

namespace Tests\Feature\Client;


use App\Client;

class ShowTest extends ClientTest
{
    public function test_authenticated_users_can_show_clients()
    {
        $client = create(Client::class);

        $this
            ->authenticatedAdmin()
            ->show($client->id)
            ->assertStatus(200)
            ->assertSeeText($client->id);
    }

    public function show($clientId)
    {
        return $this->makeGetRequest(['show', $clientId]);
    }
}