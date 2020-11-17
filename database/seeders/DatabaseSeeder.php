<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=============================================================================================================
        // Employee Seeder
        //=============================================================================================================
        DB::table('employee')->insert(
            [
                'name' => 'Albertus',
                'email' => 'albertus@gmail.com',
                'phone' => '087854563231',
                'address' => 'Jl. Kenangan no. 14',
                'password' => Hash::make('owner'),
                'raiseIteration' => 0,
                'role' => 'owner'
            ]
        );
        DB::table('employee')->insert(
            [
                'name' => 'Watson',
                'email' => 'watson@gmail.com',
                'phone' => '0896721456311',
                'address' => 'Jl. jalan no. 24',
                'password' => Hash::make('sales'),
                'raiseIteration' => 0,
                'role' => 'sales'
            ]
        );
        DB::table('employee')->insert(
            [
                'name' => 'Holmes',
                'email' => 'holmes@gmail.com',
                'phone' => '0812237261872',
                'address' => 'Jl. saturnus no. 34',
                'password' => Hash::make('inventory'),
                'raiseIteration' => 0,
                'role' => 'inventory'
            ]
        );

        //=============================================================================================================
        // Vendor Seeder
        //=============================================================================================================
        DB::table('vendor')->insert(
            [
                'companyCode' => 'clas',
                'name' => 'Clarissa',
                'email' => 'clarissa@gmail.com',
                'telephone' => '022-5456323',
                'address' => 'Jl. Jendral Sudirman no. 34'
            ]
        );
        DB::table('vendor')->insert(
            [
                'companyCode' => 'jpra',
                'name' => 'Jepara',
                'email' => 'jepara@gmail.com',
                'telephone' => '022-5236231',
                'address' => 'Jl. Soeta 116'
            ]
        );

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

        //=============================================================================================================
        // Meuble Category
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
