<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 0,
            'name' => '東京都'
        ];
        DB::table('locations')->insert($param);
        $param = [
            'id' => 1,
            'name' => '大阪府'
        ];
        DB::table('locations')->insert($param);
        $param = [
            'id' => 2,
            'name' => '福岡県'
        ];
        DB::table('locations')->insert($param);
    }
}
