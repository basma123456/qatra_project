<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mosque;
use Illuminate\Http\Request;

class MosqueSerchController extends Controller
{
    function index(Request $request)
    {
        $mosques_json = json_decode(file_get_contents(url("mosques.json")));
        $c = 0;
        foreach ($mosques_json->features as $item) {
            echo "<h1>اسم المسجد : " . $item->attributes->Mosque_Name . "</h1>";
            echo "<p>رمز : " . $item->attributes->code . "</p>";
            echo "<p>رقم المسجد : " . $item->attributes->MosqueNationalCode . "</p>";
            echo "<a target='_blank' href='https://maps.google.com/?daddr=" . $item->attributes->Northing . "+" . $item->attributes->Easting . "'>موقع المسجد</a>";
            $name_ar = "مسجد ";
            $name_en = "مسجد ";
            $name_ar .= trim($item->attributes->Mosque_Name);
            $name_en .= trim($item->attributes->Mosque_Name);
            
            $row = [
                'name_ar' => trim($name_ar),
                'name_en' => trim($name_en),
                'latitude' => $item->attributes->Northing,
                'longitude' => $item->attributes->Easting,
                'capacity' => 1,
                'rows' => 1,
                'row_length' => 1,
                'status' => 1,
                'city_id' => 1,
                'district_id' => 1,
            ];
            Mosque::create($row);
        }


        // return $mosques_json;
    }
}
