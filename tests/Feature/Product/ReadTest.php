<?php

namespace Tests\Feature\Product;


use App\Client;
use App\Provider;

class ReadTest extends ProductTest
{

    public function test_unauthenticated_users_cannot_hit_the_read_endpoint()
    {
        $this->read()
            ->assertStatus(401)
            ->assertSeeText('Unauthenticated');
    }

    public function test_authenticated_users_without_client_cannot_read_products()
    {
        $this->authenticated()
            ->read()
            ->assertStatus(403)
            ->assertSeeText('unauthorized');
    }

    public function test_authenticated_users_with_client_can_read_its_own_products()
    {
        $client = create(Client::class);
        $user = $client->creator;
        $provider = create(Provider::class, [
            'client_id' => $client->id
        ]);
        $products = $this->createProduct([
            'client_id' => $client->id,
            'provider_id' => $provider->id
        ], 20)->toArray();

        $products[] = $this->createProduct([
            'client_id' => $client->id,
            'provider_id' => $provider->id,
            'name' => 'some dummy test name',
            'description' => 'some dummy description',
            'buy_price' => 666.66,
            'sell_price' => 777.77
        ]);

        $res = $this
            ->authenticated($user)
            ->read();

        $res->assertStatus(200);

        foreach(array_slice($products, 0, 15) as $product) {
            $res->assertSeeText($product['name'])
                ->assertSeeText($product['description'])
                ->assertSeeText($product['buy_price'])
                ->assertSeeText($product['sell_price']);
        }

        $res->assertDontSeeText($products[20]['name'])
            ->assertDontSeeText($products[20]['description'])
            ->assertDontSeeText($products[20]['buy_price'])
            ->assertDontSeeText($products[20]['sell_price']);

        $res->assertPaginationResource();
    }

    public function read()
    {
        return $this->makeGetRequest('index');
    }
}