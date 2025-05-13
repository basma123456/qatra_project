<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Marketer;
use App\Models\Masjedtemp;
use App\Models\Mosque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use stdClass;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MosqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $where = [
        //     'status' => 1
        // ];
        $code = null;
        if ($request->aff) {
            $code = $request->aff;
            $marketer = Marketer::where('affiliate_code', $code)->first();
            if ($marketer) {
                Cookie::queue('marketer_id', $marketer->id, 21600);
            }
        }
        $where = [
            'status' => 1,
        ];
        $district = null;
        $mosques = null;
        if ($request->district_id) {
            $district = District::find($request->district_id);
            $where = [
                'status' => 1,
                'district_id' => $district->id,
            ];
            $mosques = Mosque::where($where)->orderby("name_ar")->get();
        }
        // else {
        //     $district = District::find(2);
        // }


        $favorites = [];
        if (Auth::user())
            $favorites = Auth::user()->favorites;
        $districts = District::where("status", 1)->orderby("name_ar")->get();
        // return $favorites;
        return view("front.mosques.index", compact("favorites", "districts", "request", "district", "mosques","code"));
    }

    public function index2()
    {
        // $mosques = Mosque::all();
        // foreach($mosques as $mosque){
        //     $where=[
        //         'lat'=>$mosque->latitude,
        //         'lng'=>$mosque->longitude,
        //     ];
        //     $masjedtemp = Masjedtemp::where($where)->first();
        //     if($masjedtemp){
        //         $mosque->cid = $masjedtemp->cid;
        //         $mosque->save();
        //     }
        // }
        $where = [
            'status' => 1
        ];
        $mosques = Mosque::where($where)->get();
        $favorites = Auth::user()->favorites;
        // return $favorites;
        return view("front.mosques.index2", compact("mosques", "favorites"));
    }

    function search($text)
    {
        // $text = $request->all();
        // $text = trim($text);
        // return $request;
        $mosques = Mosque::where('name_ar', 'like', '%' . $text . '%')->limit(20)->orderBy('name_ar')->get();
        return view("front.mosques.search", compact("mosques"));
    }

    // function image(String $image){

    // }

    function json(District $district = null)
    {
        if (is_null($district)) {
            $district_id = 1;
        } else {
            $district_id = $district->id;
        }
        $where = [
            'status' => 1,
            'district_id' => $district_id,
        ];
        $mosques = Mosque::where($where)->orderby("name_ar")->get();
        return view("front.mosques.json", compact("mosques"));
    }
    function json_item(Request $request, $cid)
    {
        $sestion_id = $request->session()->getId();
        // return $sestion_id;
        $perMinute = 8;
        if (RateLimiter::remaining('mosque-data:' . $sestion_id, $perMinute)) {
            RateLimiter::hit('mosque-data:' . $sestion_id);

            $cid = base64_decode($cid);
            $where = [
                'status' => 1,
                'cid' => $cid,
            ];

            $mosque = Mosque::where($where)->get()->first();
            // return $mosque->id;
            if ($mosque) {
                $obj = new stdClass();
                $obj->title = $mosque->name_ar;
                $imgs = [];
                for ($i = 1; $i <= 3; $i++) {
                    $var = "img" . $i;
                    if (!is_null($mosque->$var)) {
                        // $imgs[] =  url("public/storage/". $mosque->$var);
                        // $imgs[] =  url("assets/images/mosque_img_default.png");
                        // $imgs[] = "https://qatra.sa/public/storage/" . $mosque->$var;
                        $imgs[] = route("front.mosque.item.image", $mosque->$var);
                    }
                }
                if (count($imgs) > 0) {
                    $obj->imgs = $imgs;
                } else {
                    $imgs[] = url("assets/images/qatra_placeholder.jpeg");
                    $obj->imgs = $imgs;
                }
                // return $imgs;
                $obj->img = $imgs[0];
                $obj->address = $mosque->city->name_ar . " ، " . $mosque->district->name_ar;
                $obj->link = ($mosque->is_full) ? null : route('front.products', $mosque->id);
            } else {
                $obj = new stdClass();
                $obj->title = "غير معروف";
                $obj->img = "";
                $obj->address = "غير معروف";
                $obj->link = route("front.home");
            }

            return response()->json($obj);
        } else {
            $obj = new stdClass();
            $obj->title = "Rate Limiter";
            $obj->img = "";
            $obj->address = "Rate Limiter";
            $obj->link = route("front.home");
            return "Rate Limiter ";
        }

        // return view("front.mosques.json", compact("mosques"));
    }


    function image(String $image)
    {
        $image = Str::random(12).".jpg";
        $file_url = 'storage/' . $image;
        $file_url = 'assets/images/qatra_placeholder.jpeg';
        $file_url_thump = 'storage/thumbnail/' . $image;
        if (is_file($file_url_thump)) {
            $img = Image::make($file_url_thump);
            return $img->response('jpg');
        }
        $img = Image::make($file_url);
        $img->fit(800, 600, function ($constraint) {
            $constraint->upsize();
        });
        $width = $img->width();
        $height = $img->height();
        $x = 0;
        while ($x < $width) {
            $y = 0;

            while ($y < $height) {

                $img->text("www.Qatra.sa", $x, $y, function ($font) {
                    $font->file('public/Cairo-Regular.ttf');
                    $font->size(27);
                    $font->align('center');
                    $font->valign('middle');
                    $font->angle(45);
                    $font->color([255, 255, 255, 0.15]);
                });
                $y += 120;
            }

            $x += 170;
        }
        $img->save($file_url_thump, 80, 'jpg');
        header('Content-Type: image/png');
        return $img->response('jpg', 70);
    }
}
