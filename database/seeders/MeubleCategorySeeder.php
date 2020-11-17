<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeubleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=============================================================================================================
        // Meuble Category
        //=============================================================================================================
        DB::table('meuble_category')->insert(
            [
                'id' => 1,
                'description' => 'Table'
            ]
        );
        DB::table('meuble_category')->insert(
            [
                'id' => 2,
                'description' => 'Chair'
            ]
        );
        DB::table('meuble_category')->insert(
            [
                'id' => 3,
                'description' => 'Wardrobe'
            ]
        );
        DB::table('meuble_category')->insert(
            [
                'id' => 4,
                'description' => 'Sofa'
            ]
        );
        DB::table('meuble_category')->insert(
            [
                'id' => 5,
                'description' => 'Bed'
            ]
        );
    }
}
