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

            $table->string('fax');
            $table->string('kitchen_id');
            $table->string('zipcode');
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
            $table->string('name');
            $table->string('mobile');

            $table->dropColumn('fax');
            $table->dropColumn('kitchen_id');
            $table->dropColumn('zipcode');
        });
    }
}
