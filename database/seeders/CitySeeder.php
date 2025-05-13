<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = [
            'name_ar'=>"مكة المكرمة",
            'name_en'=>"Makkah",
            'status'=>1
        ];
        City::create($row);
        $row = [
            'name_ar'=>"المدينة المنورة",
            'name_en'=>"Madina",
            'status'=>0
        ];
        City::create($row);
        $row = [
            'name_ar'=>"جدة",
            'name_en'=>"Jeddah",
            'status'=>0
        ];
        City::create($row);
    }
}
