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
        Schema::dropIfExists(('template_child_categories'));

        Schema::create('template_child_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('template_child_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('custom_code')->nullable();
            $table->string('bill_date')->nullable();
            $table->string('bill_number')->nullable();
            $table->string('amount')->nullable();
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