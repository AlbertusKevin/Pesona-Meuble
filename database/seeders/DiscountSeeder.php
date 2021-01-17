<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiscountSeeder extends Seeder
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
        DB::table('discount')->insert(
            [
                "code" => 'default_m',
                "description" => 'default code for meuble',
                "percentDisc" => 0.00,
                "responsibleEmployee" => 1,
                "statusActive" => 1,
                "from" => Carbon::parse('2018-12-01')->format('Y-m-d'),
                "to" => Carbon::parse('9999-12-31')->format('Y-m-d')
            ]
        );
    }
}
