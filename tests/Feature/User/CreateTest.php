<?php

namespace Tests\Feature\User;

use App\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends UserTest
{
    public function test_unauthenticated_users_can_hit_the_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_are_now_allowed_to_create_users()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_are_allowed_to_create_users()
    {
        Storage::fake('public');

        $user = $this->makeUser()->toArray();
        $user['password'] = '123456';
        $user['password_confirmation'] = $user['password'];
        $user['image'] = UploadedFile::fake()->image('user.png');

        $response = $this
            ->authenticatedAdmin()
            ->create($user);

        $response
            ->assertStatus(201)
            ->assertSeeText($user['name'])
            ->assertSeeText($user['email']);

        $data = json_decode((string)$response->getContent());
        $imageName = basename($data->data->image);

        $this->assertDatabaseHas('users', [
            'id' => $data->data->id
        ]);

        Storage::disk('public')->assertExists($imageName);
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
