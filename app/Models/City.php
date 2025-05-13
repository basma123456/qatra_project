<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'status',
    ];
    protected $appends = ['name'];

    function getNameAttribute()
    {
        $lang = app()->getLocale();
        $var = "name_" . $lang;
        return $this->$var;
    }

    function mosques()
    {
        return $this->hasMany(Mosque::class);
    }

}
