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
        Schema::create('template_child_categories', function (Blueprint $table) {
            $table->id();
            $table->string('template_child_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('custom_code')->nullable();
            $table->string('bill_date')->nullable();
            $table->string('bill_number')->nullable();
            $table->string('amount')->nullable();
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
