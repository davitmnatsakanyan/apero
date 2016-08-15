<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKitchensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchens', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });



        Schema::create('caterer_kitchen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('caterer_id')->unsigned();
            $table->foreign('caterer_id')
                ->references('id')
                ->on('caterers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('kitchen_id')->unsigned();
            $table->foreign('kitchen_id')
                ->references('id')
                ->on('kitchens')
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
        Schema::drop('caterer_kitchen');
        Schema::drop('kitchens');
    }
}
