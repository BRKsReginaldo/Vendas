<?php

namespace Tests\Feature\ProductBuy;

use App\Client;
use App\Product;
use App\ProductBuy;
use App\Provider;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends ProductBuyTest
{
    public function test_unauthenticated_users_cannot_hit_the_create_endpoint()
    {
        $this->create()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_create_product_buys()
    {
        $this->authenticated()
            ->create()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_can_create_product_buys()
    {
        $client = create(Client::class);
        $user = $client->creator;
        $provider = create(Provider::class, [
            'client_id' => $client->id
        ]);
        $product = create(Product::class, [
            'client_id' => $client->id,
            'provider_id' => $provider->id
        ]);

        $productBuy = make(ProductBuy::class, [
            'client_id' => $client->id,
            'product_id' => $product->id,
            'user_id' => $user->id
        ])->toArray();

        $this->authenticated($user)
            ->create($productBuy)
            ->assertStatus(201)
            ->assertSeeText($product->name)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'product',
                    'product_id',
                    'observations',
                    'client_id',
                    'amount'
                ]
            ]);

        $this->assertDatabaseHas('product_buys', [
            'product_id' => $product->id,
            'client_id' => $client->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('product_transactions', [
            'product_id' => $product->id,
            'client_id' => $client->id,
            'user_id' => $user->id,
            'new_stock' => $productBuy['amount']
        ]);

        $this->assertCount(1, ProductBuy::get());
        $this->assertEquals($productBuy['amount'], $product->fresh()->stock);
    }

    public function create($data = [])
    {
        return $this->makePostRequest('store', $data);
    }
}
