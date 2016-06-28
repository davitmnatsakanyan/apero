<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('caterer_id')->unsigned();
            $table->string('title');
            $table->string('prename');
            $table->string('name');
            $table->integer('mobile');
            $table->integer('phone');
            $table->string('email');
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
        Schema::drop('contact_people');
    }
}
