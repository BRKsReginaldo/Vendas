<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('provider_id');
            $table->unsignedInteger('client_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('buy_price');
            $table->decimal('sell_price');
            $table->float('stock')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
