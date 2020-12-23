<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EmployeeSeeder::class,
            CustomerSeeder::class,
            MeubleCategorySeeder::class,
            StatusTransactionSeeder::class,
            VendorSeeder::class,
            DiscountSeeder::class
        ]);
    }
}
