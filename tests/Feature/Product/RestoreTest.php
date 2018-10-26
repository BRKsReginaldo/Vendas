<?php

namespace Tests\Feature\Product;


use App\Client;

class RestoreTest extends ProductTest
{
    public function test_unauthenticated_users_cannot_hit_the_restore_endpoint()
    {
        $product = $this->createProduct();
        $product->delete();

        $this->restore($product->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_restore_products()
    {
        $product = $this->createProduct();
        $product->delete();

        $this->authenticated()
            ->restore($product->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_cannot_restore_other_people_products()
    {
        $product = $this->createProduct();
        $product->delete();

        $client = create(Client::class);
        $user = $client->creator;

        $this->authenticated($user)
            ->restore($product->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_can_restore_its_own_products()
    {
        $product = $this->createProduct();
        $user = $product->client->creator;
        $product->delete();

        $this->authenticated($user)
            ->restore($product->id)
            ->assertStatus(200)
            ->assertSeeText('');


        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'deleted_at' => null
        ]);
    }

    public function restore($productId)
    {
        return $this->makePutRequest(['restore', $productId]);
    }
}