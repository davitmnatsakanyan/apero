<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubproductIdToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('package_product',function(Blueprint $table){
           $table->integer('subproduct_id')->nullbale(false);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_product',function(Blueprint $table){
            $table->dropColumn('subproduct_id')->nullbale(false);
        });
    }
}
