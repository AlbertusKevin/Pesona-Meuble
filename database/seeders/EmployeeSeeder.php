<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
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
                'role' => 'owner',
                'status' => 1,
                'salary' => 0
            ]
        );
        DB::table('employee')->insert(
            [
                'name' => 'Chris',
                'email' => 'chris@gmail.com',
                'phone' => '0896721456311',
                'address' => 'Jl. jalan no. 24',
                'password' => Hash::make('sales'),
                'raiseIteration' => 0,
                'role' => 'sales',
                'status' => 1,
                'salary' => 3500000
            ]
        );
        DB::table('employee')->insert(
            [
                'name' => 'Mikhael',
                'email' => 'mikhael@gmail.com',
                'phone' => '0812237261872',
                'address' => 'Jl. saturnus no. 34',
                'password' => Hash::make('inventory'),
                'raiseIteration' => 0,
                'role' => 'inventory',
                'status' => 1,
                'salary' => 3000000
            ]
        );
    }
}
