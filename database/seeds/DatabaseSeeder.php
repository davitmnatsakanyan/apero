<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(AdminsTableSeeder::class);
//         $this->call(CaterersTableSeeder::class);
//         $this->call(ProductsTableSeeder::class);
//         $this->call(OrdersTableSeeder::class);
//         $this->call(OrderProductsTableSeeder::class);
//         $this->call(OrderTranzactionsTableSeeder::class);
//         $this->call(ZipCodesTranzactionsTableSeeder::class);
         
    }
}
