<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
    ];
    protected $appends = ['name'];
    function getNameAttribute(){
        $lang = app()->getLocale();
        $var = "name_".$lang;
        return $this->$var;
    }
}
