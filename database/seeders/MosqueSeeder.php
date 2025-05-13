<?php

namespace Database\Seeders;

use App\Models\MessageType;
use App\Models\Mosque;
use App\Models\MosqueType;
use App\Models\PlaceType;
use Illuminate\Database\Seeder;

class MosqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, url("manifest.json"));
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $jsonDataString = curl_exec($curlSession);
        curl_close($curlSession);
        $mosques_json = json_decode($jsonDataString);
        // $mosques_json = json_decode(file_get_contents(url("mosques.json")));
        $c = 0;
        // foreach ($mosques_json->features as $item) {
        //     // echo "<h1>اسم المسجد : " . $item->attributes->Mosque_Name . "</h1>";
        //     // echo "<p>رمز : " . $item->attributes->code . "</p>";
        //     // echo "<p>رقم المسجد : " . $item->attributes->MosqueNationalCode . "</p>";
        //     // echo "<a target='_blank' href='https://maps.google.com/?daddr=" . $item->attributes->Northing . "+" . $item->attributes->Easting . "'>موقع المسجد</a>";
        //     $name_ar = "مسجد ";
        //     $name_en = "مسجد ";
        //     $name_ar .= trim($item->attributes->Mosque_Name);
        //     $name_en .= trim($item->attributes->Mosque_Name);
        //     // if (strlen($name_ar) == 0) {

        //     // }
        //     $row = [
        //         'name_ar' => trim($name_ar),
        //         'name_en' => trim($name_en),
        //         'latitude' => $item->attributes->Northing,
        //         'longitude' => $item->attributes->Easting,
        //         'capacity' => 1,
        //         'rows' => 1,
        //         'row_length' => 1,
        //         'status' => 1,
        //         'city_id' => 1,
        //         'district_id' => 1,
        //     ];
        //     Mosque::create($row);
        // }

        $row = [
            'title'=>"مسجد"
        ];
        MosqueType::create($row);
        $row = [
            'title'=>"جامع"
        ];
        MosqueType::create($row);
        $row = [
            'title'=>"مصلى"
        ];
        MosqueType::create($row);
        $row = [
            'title'=>"جبل وعر",
            'price'=>15,
        ];
        PlaceType::create($row);
        $row = [
            'title'=>"جبل سهل",
            'price'=>15,
        ];
        PlaceType::create($row);
        $row = [
            'title'=>"حارة صعبة",
            'price'=>15,
        ];
        PlaceType::create($row);
        $row = [
            'title'=>"مكان عام",
            'price'=>15,
        ];
        PlaceType::create($row);
        $row = [
            'title'=>"داخل ملكية",
            'price'=>15,
        ];
        PlaceType::create($row);
        $row = [
            'title'=>"رسالة تأكيد الحوالة",
            'id'=>101,
        ];
        MessageType::create($row);
        $row = [
            'title'=>"رسالة الدفع الالكتروني",
            'id'=>201,
        ];
        MessageType::create($row);
        $row = [
            'title'=>"رسالة الخروج للتوصيل",
            'id'=>301,
        ];
        MessageType::create($row);
        $row = [
            'title'=>"رسالة اتمام التوصيل",
            'id'=>401,
        ];
        MessageType::create($row);
        $row = [
            'title'=>"رسالة تذكير بعد 10 أيام",
            'id'=>501,
        ];
        MessageType::create($row);
        $row = [
            'title'=>"رسالة يوم الجمعة",
            'id'=>601,
        ];
        MessageType::create($row);
    }
}
