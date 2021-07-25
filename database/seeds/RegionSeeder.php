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
            ['Region' => 'Magway Region',],
            ['Region' => 'Mandalay Region',],
            ['Region' => 'Naypyidaw Union Territory',],
            ['Region' => 'Kayah State',],
            ['Region' => 'Shan State',],
            ['Region' => 'Ayeyarwady Region',],
            ['Region' => 'Bago Region',],
            ['Region' => 'Yangon Region',],
            ['Region' => 'Kachin State',],
            ['Region' => 'Sagaing Region',],
            ['Region' => 'Kayin State',],
            ['Region' => 'Mon State',],
            ['Region' => 'Tanintharyi Region',],
            ['Region' => 'Chin State',],
            ['Region' => 'Rakhine State',],
        ]);
    }
}
