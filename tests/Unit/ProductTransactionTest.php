<?php

namespace Tests\Unit;

use App\Client;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTransactionTest extends TestCase
{
    use DatabaseMigrations;

    public function test_product_stock_changes_when_product_transaction_is_created()
    {
        $client = create(Client::class);
        $user = $client->creator;
        $product = create(Product::class, [
            'client_id' => $client->id
        ]);

        $this->assertEquals(0, $product->stock);

        $product->makeTransaction(5);

        $product = $product->fresh();

        $this->assertEquals(5, $product->stock);

        $this->assertDatabaseHas('product_transactions', [
            'product_id' => $product->id,
            'old_stock' => 0,
            'new_stock' => 5
        ]);

        $product->makeTransaction(4);

        $product = $product->fresh();

        $this->assertEquals(4, $product->stock);

        $this->assertDatabaseHas('product_transactions', [
            'product_id' => $product->id,
            'old_stock' => 5,
            'new_stock' => 4
        ]);
    }
}
