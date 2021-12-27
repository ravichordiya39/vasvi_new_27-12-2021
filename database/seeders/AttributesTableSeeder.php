<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('colors')->insert([
            [
                'id'             => 1,
                'name'           => 'Red',
                'value'          => '#FF0000',
                'status'         => 1,

            ],
            [
                'id'             => 2,
                'name'           => 'Green',
                'value'          => '#008000',
                'status'         => 1,

            ],
            [
                'id'             => 3,
                'name'           => 'Yellow',
                'value'          => '#FFFF00',
                'status'         => 1,

            ],
            [
                'id'             => 4,
                'name'           => 'Black',
                'value'          => '#000000',
                'status'         => 1,

            ],
            [
                'id'             => 5,
                'name'           => 'blue',
                'value'          => '#0000FF',
                'status'         => 1,

            ],
        ]);

        DB::table('sizes')->insert([
            [
                'id'             => 1,
                'name'           => 'S',
                'value'          => '24',
                'status'         => 1,

            ],
            [
                'id'             => 2,
                'name'           => 'M',
                'value'          => '30',
                'status'         => 1,

            ],
            [
                'id'             => 3,
                'name'           => 'L',
                'value'          => '34',
                'status'         => 1,

            ],
            [
                'id'             => 4,
                'name'           => 'XL',
                'value'          => '42',
                'status'         => 1,

            ],
            [
                'id'             => 5,
                'name'           => 'XXLL',
                'value'          => '55',
                'status'         => 1,

            ],
        ]);

        DB::table('brands')->insert([
            [
                'id'             => 1,
                'name'           => 'Vasvi New',
                'logo'           =>  '2b989f0bcf2505ad713985e8f5a1ff50.png',
                'description'    =>  'description',
                'status'         => 1,

            ],
            [
                'id'             => 2,
                'name'           => 'Vasvi',
                'logo'           => '5157ed54dcb1af5007ec995ec3c3cbda.png',
                'description'    => 'description',
                'status'         => 1,

            ],
        ]);
    }
}
