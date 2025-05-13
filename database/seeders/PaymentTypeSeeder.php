<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = [
            'name_ar'=>"بطاقة ائتمانية / مدى",
            'name_en'=>"Credit Card / Mada",
        ];
        PaymentType::create($row);
        $row = [
            'name_ar'=>"تحويل بنكي",
            'name_en'=>"Bank Transfer",
        ];
        PaymentType::create($row);
    }
}
