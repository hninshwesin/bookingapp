<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            ['region' => 'Magway', 'sort_order' => 6,],
            ['region' => 'Mandalay', 'sort_order' => 2,],
            ['region' => 'Naypyidaw Union Territory', 'sort_order' => 3,],
            ['region' => 'Kayah', 'sort_order' => 10,],
            ['region' => 'Shan', 'sort_order' => 15,],
            ['region' => 'Ayeyarwady', 'sort_order' => 5,],
            ['region' => 'Bago', 'sort_order' => 4,],
            ['region' => 'Yangon', 'sort_order' => 1,],
            ['region' => 'Kachin', 'sort_order' => 9,],
            ['region' => 'Sagaing', 'sort_order' => 7,],
            ['region' => 'Kayin', 'sort_order' => 11,],
            ['region' => 'Mon', 'sort_order' => 13,],
            ['region' => 'Tanintharyi', 'sort_order' => 8,],
            ['region' => 'Chin', 'sort_order' => 12,],
            ['region' => 'Rakhine', 'sort_order' => 14,],
        ]);
    }
}
