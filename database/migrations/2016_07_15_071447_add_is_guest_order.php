<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsGuestOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('orders', function (Blueprint $table){
           $table->dropForeign('orders_ibfk_1');
           $table->dropUnique('orders_email_unique');
           $table->dateTime('delivery_time');
           $table->integer('is_user_order');

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
            $table->unique('email');
            $table->dropColumn('delivery_time');
            $table->dropColumn('is_user_order');
            $table->foreign('user_id','foreign_guests_table')
                ->references('id')
                ->on('guests')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
}
