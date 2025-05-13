<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'name'=>'سلايد 1',
            'img_ar'=>'assets/slides/Ad11.png',
            'img_en'=>'assets/slides/Ad11.png',
            'status'=>1,
        ]);
        Slider::create([
            'name'=>'سلايد 2',
            'img_ar'=>'assets/slides/Ad11.png',
            'img_en'=>'assets/slides/Ad11.png',
            'status'=>1,
        ]);
        Slider::create([
            'name'=>'سلايد 3',
            'img_ar'=>'assets/slides/Ad11.png',
            'img_en'=>'assets/slides/Ad11.png',
            'status'=>1,
        ]);
    }
}
