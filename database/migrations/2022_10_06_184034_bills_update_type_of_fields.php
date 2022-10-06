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
        Schema::table('bills', function (Blueprint $table) {
            $table->unsignedInteger('type')->change();
            $table->unsignedInteger('bill_number')->change();
            $table->unsignedInteger('currency')->change();
            $table->unsignedInteger('exchange')->change();
            $table->unsignedInteger('tva')->change();
            $table->unsignedInteger('item')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('type');
            $table->dropColumn('bill_number');
            $table->dropColumn('currency');
            $table->dropColumn('exchange');
            $table->dropColumn('tva');
            $table->dropColumn('item');
        });
    }
};
