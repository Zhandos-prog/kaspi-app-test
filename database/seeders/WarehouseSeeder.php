<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warehouse')->insert([
            [
                'user_id'=>1,
                'name'=>'Склад Каспи Магазин-1',
                'address'=>'Аль-фараби 52'
            ],
            [
                'user_id'=>2,
                'name'=>'Склад Каспи Магазин-2',
                'address'=>'Аль-фараби 52'
            ]
        ]);
    }
}
