<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;

class DeliveryTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = [
            'name_ar'=>"توصيل مباشر للمسجد",
            'name_en'=>"Direct Delivery",
        ];
        DeliveryType::create($row);
        $row = [
            'name_ar'=>"تسليم شخص معين",
            'name_en'=>"Delivery to a person",
        ];
        DeliveryType::create($row);
    }
}
