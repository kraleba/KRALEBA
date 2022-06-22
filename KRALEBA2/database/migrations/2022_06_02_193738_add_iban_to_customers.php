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
        Schema::table('customers', function (Blueprint $table) {
            $table->text('type');
            $table->text('address')->nullable();
            $table->text('zipCode')->nullable();
            $table->text('city')->nullable();
            $table->integer('country');
            $table->text('cif')->nullable();
            $table->text('ocr')->nullable();
            $table->text('iban')->nullable();
            $table->text('swift')->nullable();
            $table->text('bank')->nullable();
            $table->text('contact')->nullable();
            $table->text('phone')->nullable();
            $table->text('phone2')->nullable();
            $table->text('email')->nullable();
            $table->text('www')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
