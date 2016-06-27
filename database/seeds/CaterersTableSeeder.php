<?php

use Illuminate\Database\Seeder;

class CaterersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('caterers')->insert([
            'name' => 'caterer',
            'email' => 'caterer@gmail.com',
            'password' => bcrypt('caterer'),
        ]);
    }
}
