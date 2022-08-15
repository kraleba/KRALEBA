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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('category_id');
            $table->string('specify_id');
            $table->string('unique_code');
            $table->string('type');
            $table->string('bill_date');
            $table->string('bill_number');
            $table->string('currency');
            $table->string('exchange');
            $table->string('TVA');
            $table->string('item');
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
        Schema::dropIfExists('bills');
    }
};
