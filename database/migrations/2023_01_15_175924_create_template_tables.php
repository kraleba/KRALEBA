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
        Schema::create('template_parents', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('tailoring_id')->nullable();
            $table->string('category')->nullable();
            $table->string('theme')->nullable();
            $table->string('styles')->nullable();
            $table->string('occasion')->nullable();
            $table->string('seasonality')->nullable();
            $table->string('author')->nullable();
            $table->string('collection')->nullable();
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
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('template_parents');
    }
};
