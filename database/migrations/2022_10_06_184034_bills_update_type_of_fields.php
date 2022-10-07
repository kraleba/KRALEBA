<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('bills', function (Blueprint $table) {
//            $table->integer('type')->change();
//            $table->unsignedBigInteger('bill_number')->change();
//            $table->unsignedBigInteger('currency')->change();
//            $table->unsignedBigInteger('exchange')->change();
//            $table->unsignedBigInteger('tva')->change();
//            $table->unsignedBigInteger('item')->change();
        DB::statement('alter table bills
    alter column type type integer using type::integer');
//    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('bills', function (Blueprint $table) {
//            $table->dropColumn('user_id');
//            $table->dropColumn('type');
//            $table->dropColumn('bill_number');
//            $table->dropColumn('currency');
//            $table->dropColumn('exchange');
//            $table->dropColumn('tva');
//            $table->dropColumn('item');
//        });
    }
};
//trebie sa rezolv problema cu schimbarea tipului coloanei
