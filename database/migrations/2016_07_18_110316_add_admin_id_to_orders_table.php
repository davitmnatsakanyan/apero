<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders',function (Blueprint $table){
            $table->integer('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade')
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
        Schema::table('orders' ,function (Blueprint $table){
            $table->dropForeign('orders_admin_id_foreign');
            $table->dropColumn('admin_id');
        });
    }
}
