<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
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
        DB::table('vendor')->insert(
            [
                'companyCode' => 'clas',
                'name' => 'Clarissa',
                'email' => 'clarissa@gmail.com',
                'telephone' => '022-5456323',
                'address' => 'Jl. Jendral Sudirman no. 34',
                'status' => 1
            ]
        );
        DB::table('vendor')->insert(
            [
                'companyCode' => 'jpra',
                'name' => 'Jepara',
                'email' => 'jepara@gmail.com',
                'telephone' => '022-5236231',
                'address' => 'Jl. Soeta 116',
                'status' => 1
            ]
        );
    }
}
