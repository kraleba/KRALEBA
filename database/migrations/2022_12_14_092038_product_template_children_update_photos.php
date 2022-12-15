<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_template_children', function (Blueprint $table) {

            $table->renameColumn('template_child_photo', 'template_photo1');
            $table->string('template_photo2')->nullable();
            $table->string('template_photo3')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_template_children', function (Blueprint $table) {
            $table->renameColumn('template_child_photo', 'template_photo1');
            $table->dropColumn(['template_photo2',  'template_photo3']);

        });
    }
};
