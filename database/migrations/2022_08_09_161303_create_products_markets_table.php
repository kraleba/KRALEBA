<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_markets', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('market_category')->nullable();
            $table->string('order_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('production_batch_code')->nullable();
            $table->string('selected_products')->nullable();
            $table->string('product_name')->nullable();
            $table->string('template_id')->nullable();
            $table->string('manufactured_products')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_markets');
    }
};
