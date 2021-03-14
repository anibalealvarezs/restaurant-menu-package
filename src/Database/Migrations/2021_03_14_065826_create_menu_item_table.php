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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('menu_item_id');
            $table->integer('menu_id')->nullable(false);
            $table->string('name', 254)->nullable(false);
            $table->string('description', 1024)->nullable();
            $table->float('price', 12, 2)->default(0);
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
        Schema::dropIfExists('menu_items');
    }
}
