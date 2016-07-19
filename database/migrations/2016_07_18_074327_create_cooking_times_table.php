<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooking_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group1')->nullable();
            $table->integer('group2')->nullable();
            $table->integer('group3')->nullable();
            $table->integer('caterer_id')->unsigned();
            $table->timestamps();
            
            
            $table->foreign('caterer_id')
                ->references('id')
                ->on('caterers')
                ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cooking_times');
    }
}
