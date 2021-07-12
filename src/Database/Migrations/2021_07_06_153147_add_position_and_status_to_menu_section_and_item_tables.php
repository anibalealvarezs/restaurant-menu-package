<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionAndStatusToMenuSectionAndItemTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_section', function (Blueprint $table) {
            $table->unsignedInteger('position')->default(1);
            $table->unsignedTinyInteger('status')->default(1);
        });
        Schema::table('menu_item', function (Blueprint $table) {
            $table->unsignedInteger('position')->default(1);
        });
        Schema::table('menu', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_section', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('status');
        });
        Schema::table('menu_item', function (Blueprint $table) {
            $table->dropColumn('position');
        });
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
