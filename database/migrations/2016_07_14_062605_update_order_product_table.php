<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_products',function (Blueprint $table){
                $table->text('description');
                $table->integer('subproduct_id')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products',function(Blueprint $table){
            $table->dropColumn('subproduct_id');
            $table->dropColumn('description');
        });
    }
}
