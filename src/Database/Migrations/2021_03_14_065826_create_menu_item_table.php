<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('menu_section_id')->nullable(false);
            $table->json('name')->nullable(false);
            $table->json('description')->nullable();
            $table->float('price', 12)->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->boolean('allow_duplicates')->default(true);
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
        Schema::dropIfExists('menu_item');
    }
}
