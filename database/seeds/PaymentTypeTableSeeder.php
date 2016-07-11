<?php

use Illuminate\Database\Seeder;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            'name' => 'paypal',

        ]);
        DB::table('payment_types')->insert([
            'name' => 'cash',

        ]);
        DB::table('payment_types')->insert([
            'name' => 'creditcard',

        ]);
    }
}
