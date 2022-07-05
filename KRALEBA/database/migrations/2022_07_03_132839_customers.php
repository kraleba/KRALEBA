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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('note')->nullable();
            $table->string('uniqueCode');
            $table->string('type');
            $table->string('address')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('city')->nullable();
            $table->string('country');
            $table->string('cif')->nullable();
            $table->string('ocr')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift')->nullable();
            $table->string('bank')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();
            $table->string('www')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
