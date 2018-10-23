<?php

namespace Tests\Feature\Provider;

use App\Provider;
use App\User;
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

    public function test_authenticated_admins_without_client_are_not_allowed_to_create_providers()
    {
        $this->authenticatedAdmin()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_admins_with_client_can_create_providers()
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $provider = $this->makeProvider([
            'client_id' => $client->id
        ])->toArray();

        $this->authenticated($user)
            ->create($provider)
            ->assertStatus(201)
            ->assertSeeText($provider['name'])
            ->assertSeeText($provider['client_id'])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'client_id'
                ]
            ]);

        $this->assertDatabaseHas('providers', $provider);
        $this->assertCount(1, Provider::get());
    }

    public function test_validation_block_us_without_name()
    {
        $this->makeValidationFor('name');
    }

    public function test_validation_block_us_without_client_id()
    {
        $this->makeValidationFor('client_id');
    }

    public function makeValidationFor($field)
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $provider = $this->makeProvider([
            'client_id' => $client->id
        ])->toArray();

        unset($provider[$field]);

        $this->authenticated($user)
            ->create($provider)
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    $field
                ]
            ]);

        $this->assertDatabaseMissing('providers', $provider);
        $this->assertCount(0, Provider::get());
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
