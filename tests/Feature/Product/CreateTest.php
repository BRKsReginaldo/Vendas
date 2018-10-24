<?php

namespace Tests\Feature\Product;

use App\Provider;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends ProductTest
{
    public function test_unauthenticated_users_cannot_hit_the_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_users_without_client_cannot_create_endpoint()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_validation_block_us_without_name()
    {
        $this->checkValidationFor('name');
    }

    public function test_validation_block_us_without_buy_price()
    {
        $this->checkValidationFor('buy_price');
    }

    public function test_validation_block_us_without_sell_price()
    {
        $this->checkValidationFor('sell_price');
    }

    public function test_validation_block_us_without_client_id()
    {
        $this->checkValidationFor('client_id');
    }

    public function test_validation_block_us_without_provider_id()
    {
        $this->checkValidationFor('provider_id');
    }

    public function test_users_can_create_products()
    {
        Storage::fake('public');

        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $provider = create(Provider::class, [
            'client_id' => $client->id
        ]);

        $data = $this->makeProduct([
            'provider_id' => $provider->id,
            'client_id' => $provider->client_id
        ])->toArray();
        $data['image'] = UploadedFile::fake()->image('product.png');

        $res = $this->authenticated($user)
            ->create($data);
        $res
            ->assertStatus(201)
            ->assertSeeText($data['name'])
            ->assertSeeText($data['description'])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'client_id',
                    'buy_price',
                    'sell_price',
                    'stock',
                    'image',
                    'image_small'
                ]
            ]);

        $json = json_decode($res->getContent());
        $image = $json->data->image;
        $baseImage = basename($image);

        Storage::disk('public')->assertExists($baseImage);

        $this->assertDatabaseHas('products', [
           'name' => $data['name'],
           'description' => $data['description']
        ]);
    }

    public function checkValidationFor($field)
    {
        $user = create(User::class);
        $client = $user->createClient();
        $user = $user->fresh();
        $provider = create(Provider::class, [
            'client_id' => $client->id
        ]);

        $data = $this->makeProduct([
            'provider_id' => $provider->id,
            'client_id' => $provider->client_id
        ])->toArray();
        unset($data[$field]);

        $this->authenticated($user)
            ->create($data)
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    $field
                ]
            ]);
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
