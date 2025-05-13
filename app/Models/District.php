<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'city_id',
        'status',
    ];
    protected $appends = ['name'];
    function getNameAttribute(){
        $lang = app()->getLocale();
        $var = "name_".$lang;
        return $this->$var;
    }

    public function city()
    {
        return $this->belongsTo(City::class , 'city_id');
    }
}
