<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = [
            'name_ar'=>"البنك الأهلي التجاري",
            'name_en'=>"Saudi National Bank",
            'account_name'=>"شركة رؤية المستقبل للتجارة",
            'account_no'=>"4505454787870",
            'iban'=>"SA124004505454787870",
            'status'=>1,
        ];
        Bank::create($row);
        
        $row = [
            'name_ar'=>"مصرف الراجحي",
            'name_en'=>"Al-Rajhi Bank",
            'account_name'=>"شركة رؤية المستقبل للتجارة",
            'account_no'=>"4505454787870",
            'iban'=>"SA124004505454787870",
            'status'=>1,
        ];
        Bank::create($row);
        
        $row = [
            'name_ar'=>"بنك البلاد",
            'name_en'=>"Bank Albilad",
            'account_name'=>"شركة رؤية المستقبل للتجارة",
            'account_no'=>"4505454787870",
            'iban'=>"SA124004505454787870",
            'status'=>1,
        ];
        Bank::create($row);
        
        $row = [
            'name_ar'=>"مصرف الإنماء",
            'name_en'=>"Alinma Bank",
            'account_name'=>"شركة رؤية المستقبل للتجارة",
            'account_no'=>"4505454787870",
            'iban'=>"SA124004505454787870",
            'status'=>1,
        ];
        Bank::create($row);
        
    }
}
