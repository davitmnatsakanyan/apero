<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });


        Schema::create('kitchen_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kitchen_id')->unsigned();
            $table->foreign('kitchen_id')
                ->references('id')
                ->on('kitchens')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::drop('kitchen_menu');
        Schema::drop('menus');
    }
}
