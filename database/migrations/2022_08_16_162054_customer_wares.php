<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists(('customer_wares'));

        Schema::create('customer_wares', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id');
            $table->integer('bill_id')->nullable();;
            $table->string('product_name')->nullable();
            $table->string('custom_code')->nullable();
            $table->string('composition')->nullable();
            $table->string('material')->nullable();
            $table->string('structure')->nullable();
            $table->string('design')->nullable();
            $table->string('weaving')->nullable();
            $table->string('color')->nullable();
            $table->string('finishing')->nullable();
            $table->string('perceived_weight')->nullable();
            $table->string('softness')->nullable();
            $table->string('look')->nullable();
            $table->string('grounds')->nullable();
            $table->string('weight_in_g/m2')->nullable();
            $table->string('width')->nullable();
            $table->string('warp_th_per_cm')->nullable();
            $table->string('warp_th_per_yarn_ne')->nullable();
            $table->string('weft_p_per_cm')->nullable();
            $table->string('origin')->nullable();
            $table->string('date')->nullable();
            $table->string('rating')->nullable();
            $table->string('description')->nullable();
            $table->string('um')->nullable();
            $table->string('amount')->nullable();
            $table->string('coin')->nullable();
            $table->string('price');
            $table->tinyInteger('status')->default('0');

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
        Schema::dropIfExists('customer_wares');
    }
};
