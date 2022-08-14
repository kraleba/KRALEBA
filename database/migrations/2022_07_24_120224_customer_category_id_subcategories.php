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
        Schema::create('customer_category_id_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('category_id')->nullable();
            $table->string('subcategory_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_category_id_subcategories');
    }
};
