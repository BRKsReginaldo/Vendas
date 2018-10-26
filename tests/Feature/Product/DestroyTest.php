<?php

namespace Tests\Feature\Product;


use App\Client;

class DestroyTest extends ProductTest
{
    public function test_unauthenticated_users_cannot_hit_the_destroy_endpoint()
    {
        $product = $this->createProduct();

        $this->destroy($product->id)
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_destroy_products()
    {
        $product = $this->createProduct();

        $this->authenticated()
            ->destroy($product->id)
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_cannot_destroy_other_people_products()
    {
        $product = $this->createProduct();
        $user = create(Client::class)->creator;

        $this->authenticated($user)
            ->destroy($product->id)
            ->assertStatus(404)
            ->assertSeeText('No query results for model');
    }

    public function test_authenticated_users_with_client_can_destroy_their_own_products()
    {
        $product = $this->createProduct();
        $user = $product->client->creator;

        $this->authenticated($user)
            ->destroy($product->id)
            ->assertStatus(200)
            ->assertSeeText('');

        $this->assertSoftDeleted('products', [
            'id' => $product->id
        ]);
    }

    public function destroy($productId)
    {
        return $this->makeDeleteRequest(['destroy', $productId]);
    }
}