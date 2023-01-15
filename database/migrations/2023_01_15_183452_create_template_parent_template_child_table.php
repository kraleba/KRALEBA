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
        Schema::create('template_parent_template_child', function (Blueprint $table) {
            $table->unsignedBigInteger('template_parent_id');
            $table->unsignedBigInteger('template_child_id');
            $table->timestamps();
            $table
                ->foreign('template_parent_id')
                ->references('id')
                ->on('template_parents')
                ->onDelete('cascade');

            $table
                ->foreign('template_child_id')
                ->references('id')
                ->on('template_children')
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
        Schema::dropIfExists('template_parent_template_child');
    }
};