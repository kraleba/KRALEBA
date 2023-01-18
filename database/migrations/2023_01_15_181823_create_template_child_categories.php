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
        Schema::create('template_child_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->unsignedBigInteger('ware_id');
            $table->string('category');
            $table
                ->foreign('child_id')
                ->references('id')
                ->on('template_children')
                ->onDelete('cascade');
            $table
                ->foreign('ware_id')
                ->references('id')
                ->on('customer_wares')
                ->onDelete('cascade');

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
        Schema::dropIfExists('template_child_categories');
    }
};
