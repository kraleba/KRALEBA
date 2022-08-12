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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('custumer_id');
            $table->string('name');
            $table->string('detail');
            $table->string('bill_date');
            $table->string('bill_number');
            $table->string('currency');
            $table->string('exchange');
            $table->string('TVA');
            $table->string('item');
            $table->string('type');
            $table->string('categiry_id');
            $table->string('specify_id');
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
        Schema::dropIfExists('invoices');
    }
};
