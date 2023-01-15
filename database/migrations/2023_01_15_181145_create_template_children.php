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
        Schema::create('template_children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->string('suffix')->nullable();
            $table->string('template_photo1')->nullable();
            $table->string('template_photo2')->nullable();
            $table->string('template_photo3')->nullable();
            $table->timestamps();

            $table
                ->foreign('parent_id')
                ->references('id')
                ->on('template_parents')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_children');
    }
};
