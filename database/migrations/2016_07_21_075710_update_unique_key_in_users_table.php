<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUniqueKeyInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users' ,function(Blueprint $table){
            $table->dropUnique('users_email_unique');
            $table->unique(['email', 'is_user']);
            $table->integer('zip')->unsigned()->change();
            $table->foreign('zip')
                ->references('id')
                ->on('zip_codes')
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
        Schema::table('users' ,function(Blueprint $table){
            $table->dropUnique('users_email_is_user_unique');
            $table->unique('email');
            $table->dropForeign('users_zip_foreign');
        });
    }
}
