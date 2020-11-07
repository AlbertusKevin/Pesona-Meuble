<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount')->insert(
            [
                'code' => 'disc1',
                'description' => 'Discount Dummy 1',
                'percentDisc' => 0.10,
                'responsibleEmployee' => 2,
                'statusActive' => 1,
                'from' => '',
                'to' => ''
            ]
        );
        DB::table('discount')->insert(
            [
                'code' => 'disc2',
                'description' => 'Discount Dummy 2',
                'percentDisc' => 0.15,
                'responsibleEmployee' => 2,
                'statusActive' => 1,
                'from' => '',
                'to' => ''
            ]
        );
    }
}
