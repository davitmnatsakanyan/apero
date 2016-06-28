<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaterersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caterers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company',250);
            $table->string('name',100);
            $table->string('address',250);
            $table->string('avatar');
            $table->string('pobox',100);
            $table->string('zip',4);
            $table->string('city',250);
            $table->string('country',250);
            $table->string('email',250)->unique();
            $table->string('phone',50);
            $table->string('mobile',50);
            $table->string('description',255);
            $table->string('products_origin',255);
            $table->string('password');
            $table->boolean('is_deleted');
            $table->integer('admin_id')->unsigned();
            $table->dateTime('deleted_at')->nullable();
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
        Schema::drop('caterers');
    }
}
