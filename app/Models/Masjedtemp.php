<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Masjedtemp extends Model
{
    
    use HasFactory,SoftDeletes;
    protected $table = "masjedtemp";
    protected $fillable = [
        'cid',
        'name_ar',
        'name_en',
        'lat',
        'lng',
        'address',
        'map_url',
        'district_id',
        'img1',
        'img2',
        'img3',
        'img4',
        'img5',
        'status',
        'place_type_id',
    ];

    function district(){
        return $this->belongsTo(District::class)->withDefault([
            'name'=>'غير معروف'
        ]);
    }
}
