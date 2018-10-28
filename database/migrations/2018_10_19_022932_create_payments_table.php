<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->morphs('payable');
            $table->decimal('original_price');
            $table->float('discount')->default(0);
            $table->boolean('discount_percentage')->default(true);
            $table->decimal('price');
            $table->unsignedInteger('payment_type_id');
            $table->integer('total_plots')->default(1);
            $table->integer('pending_plots')->default(1);
            $table->integer('paid_plots')->default(1);
            $table->date('payed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');
            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
