<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToCaterersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caterers', function (Blueprint $table) {
            $table->integer('country')->unsigned()->change();
            $table->foreign('country')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade');
            $table->integer('zip')->unsigned()->change();
            $table->foreign('zip')
                ->references('id')
                ->on('zip_codes')
                ->onUpdate('cascade');
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
            $table->dropForeign('caterers_country_foreign');
            $table->dropForeign('caterers_zip_foreign');
        });
    }
}
