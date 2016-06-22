<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->integer('caterer_id')->unsigned();
            $table->foreign('caterer_id')
                    ->references('id')
                    ->on('caterers')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->string('delivery_address',250);
            $table->string('pobox',100);
            $table->string('delivery_zip',4);
            $table->string('delivery_city',250);
            $table->string('delivery_country',250);
            $table->string('email',250)->unique();
            $table->string('phone',50);
            $table->string('mobile',50);
            $table->integer('payment_type')->unsigned();
            $table->integer('status')->unsigned();
            $table->float('total_cost');
            $table->boolean('deleted');
            $table->integer('deliter_id')->unsigned();
            $table->dateTime('deleted_time');
            $table->rememberToken();
            $table->timestamps();
            $table->string('created_ip',30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
