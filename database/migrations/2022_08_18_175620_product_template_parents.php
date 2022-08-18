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
        Schema::dropIfExists(('product_template_parents'));

        Schema::create('product_template_parents', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('category_style_id')->nullable();
            $table->integer('marketing_category_id')->nullable();
            $table->string('cuffs')->nullable();
            $table->string('slits')->nullable();
            $table->string('sleeves')->nullable();
            $table->string('pockets')->nullable();
            $table->string('stitching')->nullable();
            $table->string('seams_colour')->nullable();
            $table->string('buttons')->nullable();
            $table->string('interlining')->nullable();
            $table->string('product_name')->nullable();
            $table->string('number_of_child')->nullable();
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
        Schema::dropIfExists('product_template_parents');
    }
};
