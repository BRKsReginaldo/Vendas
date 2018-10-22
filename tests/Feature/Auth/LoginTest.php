<?php

namespace Tests\Feature\Auth;

use App\Client;
use App\User;

class LoginTest extends AuthTest
{

    /**
     * Test if any user can hit the oauth/token endpoint
     * @expected: true
     */
    public function test_any_user_can_hit_the_login_endpoint()
    {
        $this->login()
            ->assertStatus(422);
    }

    /**
     * Test if any user can login on the /oauth/token endpoint
     * @expected: true
     * Test if authenticated user can get personal info
     * @expected: true
     */
    public function test_any_user_can_login_and_get_personal_info()
    {
        $password = '123456';
        $user = create(User::class, [
            'password' => bcrypt($password)
        ]);

        create(Client::class, [
            'user_id' => $user->id
        ]);

        $response = $this->login([
            'email' => $user->email,
            'password' => $password
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token'
            ]);
    }

    public function test_disabled_client_users_are_not_allowed_to_login()
    {
        $password = '123456';
        $user = create(User::class, [
            'password' => bcrypt($password)
        ]);

        $client = create(Client::class, [
            'user_id' => $user->id
        ]);
        $client->update([
            'active' => false
        ]);

        $this->login([
            'email' => $user->email,
            'password' => $password
        ])
            ->assertStatus(401);

        $client->update([
            'active' => true
        ]);

        $this->login([
            'email' => $user->email,
            'password' => $password
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token'
            ]);
    }

    public function login($data = [])
    {
        return $this->postJson('/api/login', $data);
    }
}
