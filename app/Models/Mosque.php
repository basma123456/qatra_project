<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mosque extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'latitude',
        'longitude',
        'capacity',
        'rows',
        'row_length',
        'status',
        'city_id',
        'district_id',
        'overseer_name',
        'overseer_mobile',
        'overseer_job_id',
        'mosque_type_id',
        'place_type_id',
        'need_water',
        'has_fridge',
        'fridge_id',
        'inside_boundaries',
        'place_umrah',
        'woman_place',
        'confirmed_by',
        'confirmed_at',
        'img1',
        'img2',
        'img3',
        'img4',
        'img5',
        'cid',
        'is_full',
        'high_need',
    ];
    protected $appends = ['name'];

    function getNameAttribute()
    {
        $lang = app()->getLocale();
        $var = "name_" . $lang;
        return $this->$var;
    }

    function city()
    {
        return $this->belongsTo(City::class)->withDefault([
            'name' => 'غير معروف'
        ]);
    }

    function district()
    {
        return $this->belongsTo(District::class)->withDefault([
            'name' => 'غير معروف'
        ]);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    function status()
    {
        if ($this->status == 1) {
            $row = [
                'title' => 'مفعل',
                'badge' => 'bg-label-primary'
            ];

            return $row;
        } else {
            $row = [
                'title' => 'غير مفعل',
                'badge' => 'bg-label-warning'
            ];
            return $row;
        }
    }

    function full()
    {
        if ($this->is_full == 1) {
            $row = [
                'title' => 'نعم',
                'badge' => 'bg-label-warning'
            ];

            return $row;
        } else {
            $row = [
                'title' => 'لا',
                'badge' => 'bg-label-success'
            ];
            return $row;
        }
    }

    function confirmedby()
    {
        return $this->belongsTo(User::class, "confirmed_by")->withDefault(
            ['name' => 'غير محدد']
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class , 'product_mosques' , 'mosque_id','product_id' );
    }

    // function Distance($latFrom, $longFrom)
    // {
    //     $latFrom = deg2rad($latFrom);
    //     $longFrom = deg2rad($longFrom);
    //     $latTo = deg2rad($this->latitude);
    //     $longTo = deg2rad($this->longitude);

    //     $latDelta = $latTo - $latFrom;
    //     $lonDelta = $longTo - $longFrom;

    //     $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    //     return $angle * 6371000 / 1000; //Earth Radius
    // }
}
