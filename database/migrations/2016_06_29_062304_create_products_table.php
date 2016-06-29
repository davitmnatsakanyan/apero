<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('avatar');
            $table->text('ingredinets');
            $table->float('price');
            $table->integer('caterer_id')->unsigned();
            $table->foreign('caterer_id')
                ->references('id')
                ->on('caterers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('deleted_at')->nullable();
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
        Schema::drop('products');
    }
}
