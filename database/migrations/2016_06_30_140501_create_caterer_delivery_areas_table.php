<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatererDeliveryAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caterer_delivery_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('caterer_id')->unsigned();
            $table->integer('zip_code_id')->unsigned();
            $table->timestamps();

            $table->foreign('caterer_id')
                ->references('id')
                ->on('caterers')
                ->onDelete('cascade');

            $table->foreign('zip_code_id')
                ->references('id')
                ->on('zip_codes')
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
        Schema::drop('caterer_delivery_areas');
    }
}
