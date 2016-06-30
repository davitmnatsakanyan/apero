<?php

use Illuminate\Database\Seeder;

class ZipCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zip_codes')->truncate();
        DB::table('zip_codes')->insert([
            ['ZIP' => '35005', 'city' => 'Adamsville'],
            ['ZIP' => '35006', 'city' => 'Adger'],
            ['ZIP' => '35007', 'city' => 'Keystone'],
            ['ZIP' => '35010', 'city' => 'New Site'],
            ['ZIP' => '35014', 'city' => 'Alpine'],
            ['ZIP' => '35016', 'city' => 'Arab'],
            ['ZIP' => '35019', 'city' => 'Baileyton'],
        ]);
    }
}
