<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = [
            'id'=> 100,
            'name_ar'=>'تم التنفيذ',
            'name_en'=>'Finishid',
        ];
        OrderStatus::create($row);
        
        $row = [
            'id'=> 201,
            'name_ar'=>'في انتظار تأكيد الدفع',
            'name_en'=>'Waiting Payment',
        ];
        OrderStatus::create($row);
        $row = [
            'id'=> 202,
            'name_ar'=>'في انتظار تأكيد التحويل',
            'name_en'=>'Waiting Transfer confirmation',
        ];
        OrderStatus::create($row);
        $row = [
            'id'=> 301,
            'name_ar'=>'تحت التنفيذ',
            'name_en'=>'In Progress',
        ];
        OrderStatus::create($row);
        $row = [
            'id'=> 404,
            'name_ar'=>'ملغي',
            'name_en'=>'Canceled',
        ];
        OrderStatus::create($row);
        
        
    }
}
