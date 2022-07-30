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
        Schema::create('product_template_child', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id')->nullable();
            $table->string('suffix')->nullable();
//            $table->string('template_photo')->nullable();


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
        Schema::dropIfExists('product_template_child');
    }
};
