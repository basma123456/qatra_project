<?php

namespace App\Http\Controllers;

use App\Models\Masjedtemp;
use App\Models\Mosque;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    function index(Request $request)
    {
        $last_id = intval($request->id);
        // $districts = [19, 25, 33, 37, 55, 63, 73];
        $where = [];
        $where[] = ['id', '>=', $last_id];
        // $where[] = ['district_id', 'in',$districts];
        $where['status'] = 6;

        $rows = Masjedtemp::where($where)->limit(100)->orderby("id")->get();


        foreach ($rows as $row) {
            $last_id = $row->id;
            // if (in_array($row->district_id, $districts)) {
                $mosque = Mosque::where(['cid' => $row->cid])->first();
                if (!$mosque) {
                    $item = [
                        'cid' => $row->cid,
                        'name_ar' => $row->name_ar,
                        'name_en' => $row->name_en,
                        'latitude' => $row->lat,
                        'longitude' => $row->lng,
                        'district_id' => $row->district_id,
                        'img1' => $row->img1,
                        'img2' => $row->img2,
                        'img3' => $row->img3,
                        'img4' => $row->img4,
                        'img5' => $row->img5,
                        'place_type_id' => $row->place_type_id,
                        'city_id' => 1,
                        'status' => 1,
                        // '' => $row->id,
                        // '' => $row->id,
                        // '' => $row->id,
                        // '' => $row->id,
                    ];
                    Mosque::create($item);
                }
            // }
        }
        if ($rows->count() > 0) {
            echo '<meta http-equiv="refresh" content="2;url=' . route("front.mapping.last", $last_id) . '" />';
            echo 'ID : ' . $last_id;
        } else {
            echo "Finished";
        }
    }
}
