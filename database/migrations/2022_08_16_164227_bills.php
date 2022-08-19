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
        Schema::dropIfExists(('bills'));

        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('specify_id')->nullable();
            $table->string('unique_code')->nullable();
            $table->string('type')->nullable();
            $table->string('bill_date')->nullable();
            $table->string('bill_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('exchange')->nullable();
            $table->string('tva')->nullable();
            $table->string('item')->nullable();
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
