<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('pobox');
            $table->dropColumn('deleted');
            $table->dropColumn('deliter_id');
            $table->dropColumn('deleted_time');
            $table->dateTime('deleted_at')->nullable();
            $table->string('billing_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('pobox');
            $table->boolean('deleted');
            $table->integer('deliter_id')->unsigned();
            $table->dateTime('deleted_time');
            $table->dropColumn('deleted_at');
            $table->dropColumn('billing_address');
        });
    }
}
