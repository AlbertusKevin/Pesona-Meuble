<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=============================================================================================================
        // Vendor Seeder
        //=============================================================================================================
        DB::table('customer')->insert(
            [
                'name' => 'Martin',
                'email' => 'garrix@gmail.com',
                'phone' => '5662738812',
                'address' => 'Jl. ABCDE 22',
                'member' => '0'
            ]
        );
        DB::table('customer')->insert(
            [
                'name' => 'Watson',
                'email' => 'watson@gmail.com',
                'phone' => '6624188723',
                'address' => 'Jl. Baker Street 221B',
                'member' => '0'
            ]
        );
    }
}
