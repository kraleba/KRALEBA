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
        Schema::table('template_child_categories', function (Blueprint $table) {

            $table->renameColumn('bill_number', 'ware_id');
            $table->dropColumn('bill_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_child_categories', function (Blueprint $table) {
            $table->renameColumn('bill_number', 'ware_id');
            $table->string('bill_date');

        });
    }
};
