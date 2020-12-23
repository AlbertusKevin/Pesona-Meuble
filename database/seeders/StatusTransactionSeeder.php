<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=============================================================================================================
        // Status Transaction Seeder
        //=============================================================================================================
        DB::table('transaction_status')->insert(
            [
                'id' => 0,
                'description' => 'open'
            ]
        );
        DB::table('transaction_status')->insert(
            [
                'id' => 1,
                'description' => 'proceeded'
            ]
        );
        DB::table('transaction_status')->insert(
            [
                'id' => 2,
                'description' => 'canceled'
            ]
        );
        DB::table('transaction_status')->insert(
            [
                'id' => 3,
                'description' => 'expired'
            ]
        );
    }
}
