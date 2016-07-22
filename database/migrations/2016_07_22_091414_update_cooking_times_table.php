<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCookingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('cooking_times',function(Blueprint $table){
           $table->integer('group1')->nullable(false)->change();
           $table->integer('group2')->nullable(false)->change();
           $table->integer('group3')->nullable(false)->change();
           $table->integer('group4')->nullable(false)->change();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
