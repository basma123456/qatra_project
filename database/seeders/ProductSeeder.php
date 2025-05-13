<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = [
            'name_ar'=>"10 كراتين",
            'name_en'=>"10 Cartons",
            'img'=>"assets/images/product/water.png",
            'price'=>"100",
            'description_ar'=>"المقاس : 300 مل <br> إجمالي : 200 عبوة",
            'description_en'=>"Size : 300 ml <br> Total : 200 bottles",
            'category_id'=>1,
            'deliverable'=>1,
            'taxable'=>1,
            'status'=>1
        ];
        Product::create($row);
        $row = [
            'name_ar'=>"20 كرتون",
            'name_en'=>"20 Cartons",
            'img'=>"assets/images/product/water.png",
            'price'=>"200",
            'description_ar'=>"المقاس : 300 مل <br> إجمالي : 400 عبوة",
            'description_en'=>"Size : 300 ml <br> Total : 400 bottles",
            'category_id'=>1,
            'deliverable'=>1,
            'taxable'=>1,
            'status'=>1
        ];
        Product::create($row);
        $row = [
            'name_ar'=>"30 كرتون",
            'name_en'=>"30 Cartons",
            'img'=>"assets/images/product/water.png",
            'price'=>"300",
            'description_ar'=>"المقاس : 300 مل <br> إجمالي : 600 عبوة",
            'description_en'=>"Size : 300 ml <br> Total : 600 bottles",
            'category_id'=>1,
            'deliverable'=>1,
            'taxable'=>1,
            'status'=>1
        ];
        Product::create($row);
        $row = [
            'name_ar'=>"40 كرتون",
            'name_en'=>"40 Cartons",
            'img'=>"assets/images/product/water.png",
            'price'=>"400",
            'description_ar'=>"المقاس : 300 مل <br> إجمالي : 800 عبوة",
            'description_en'=>"Size : 300 ml <br> Total : 800 bottles",
            'category_id'=>1,
            'deliverable'=>1,
            'taxable'=>1,
            'status'=>1
        ];
        Product::create($row);
        $row = [
            'name_ar'=>"50 كرتون",
            'name_en'=>"50 Cartons",
            'img'=>"assets/images/product/water.png",
            'price'=>"500",
            'description_ar'=>"المقاس : 300 مل <br> إجمالي : 1,000 عبوة",
            'description_en'=>"Size : 300 ml <br> Total : 1,000 bottles",
            'category_id'=>1,
            'deliverable'=>1,
            'taxable'=>1,
            'status'=>1
        ];
        Product::create($row);
    }
}
