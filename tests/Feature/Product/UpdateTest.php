<?php

namespace Tests\Feature\Product;


use App\Client;
use App\Product;

class UpdateTest extends ProductTest
{
    public function test_unauthenticated_users_cannot_update_products()
    {
        $product = $this->createProduct();

        $this->update($product->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_update_products()
    {
        $product = $this->createProduct();

        $this->authenticated()
            ->update($product->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_cannot_update_other_people_products()
    {
        $product = $this->createProduct();
        $client = create(Client::class);
        $user = $client->creator;

        $this->authenticated($user)
            ->update($product->id)
            ->assertStatus(404)
            ->assertSeeText('No query results for model');
    }

    public function test_authenticated_users_can_update_their_own_products()
    {
        $product = $this->createProduct();
        $client = $product->client;
        $user = $client->creator;

        $newProduct = [
            'name' => 'test name',
            'description' => 'test description',
            'buy_price' => 27.50,
            'sell_price' => 27.50 * 1.3,
            'provider_id' => $product->provider_id,
            'client_id' => $product->client_id,
        ];

        $this->authenticated($user)
            ->update($product->id, $newProduct)
            ->assertStatus(200)
            ->assertSeeText($newProduct['name'])
            ->assertSeeText($newProduct['description'])
            ->assertSeeText($newProduct['buy_price'])
            ->assertSeeText($newProduct['sell_price'])
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'client_id',
                    'provider_id',
                    'buy_price',
                    'sell_price',
                    'stock',
                    'image',
                    'image_small'
                ]
            ]);

        $this->assertDatabaseHas('products', $newProduct);
    }

    public function update($productId, $data = [])
    {
        return $this->makePatchRequest(['update', $productId], $data);
    }
}