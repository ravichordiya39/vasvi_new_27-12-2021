<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'parent_id' => 0,
                'name' => 'Main Category',
                'slug' => 'main-category',
                'image' => '3ceaecab4348d90dd982566b6c248e44.png',
                'size_chart' => '',
                'is_home' => 1,
                'is_menu' => 1,
                'status' => 1,
            ], [
                'id' => 2,
                'parent_id' => 1,
                'name' => 'Sub Category',
                'slug' => 'sub-category',
                'image' => '9450a4596f51dd819128848336d4c859.png',
                'size_chart' => '92609e23589eef5ba7ff0792b48e027b.png',
                'is_home' => 0,
                'is_menu' => 1,
                'status' => 1,
            ],
        ]);
    }
}
