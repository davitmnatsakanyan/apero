<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company',250);
            $table->string('name',250);
            $table->string('avatar')->nullable();
            $table->string('address',250);
            $table->string('pobox',100);
            $table->string('zip',4);
            $table->string('city',250);
            $table->string('country',250);
            $table->string('email',250)->unique();
            $table->string('phone',50);
            $table->string('mobile',50);
            $table->string('password');
            $table->boolean('role');
            $table->boolean('deleted');
            $table->integer('deliter_id')->unsigned();
            $table->dateTime('deleted_at');
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
        Schema::drop('users');
    }
}
