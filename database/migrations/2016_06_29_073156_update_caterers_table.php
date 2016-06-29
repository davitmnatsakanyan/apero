<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCaterersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caterers', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('mobile');
            $table->dropColumn('deleted_time');
            $table->string('fax');
            $table->integer('kitchen_id')->unsigned();
            $table->integer('zipcode_id')->unsigned();

            $table->foreign('kitchen_id')
                ->references('id')
                ->on('kitchens')
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
        Schema::table('caterers', function (Blueprint $table) {
            $table->dropForeign('caterers_kitchen_id_foreign');
            $table->string('name');
            $table->string('mobile');
            $table->dateTime('deleted_time');
            $table->dropColumn('fax');
            $table->dropColumn('kitchen_id');
            $table->dropColumn('zipcode_id');
        });
    }
}
