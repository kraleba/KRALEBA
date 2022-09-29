<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('customer_id');
            $table->string('type');
            $table->string('bill_date');
            $table->string('bill_number');
            $table->string('currency');
            $table->string('exchange');
            $table->string('tva');
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
