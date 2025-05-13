<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'definition_ar',
        'definition_en',
        'img_ar',
        'img_en',
        'status',
    ];

    protected $appends = ['name','definition','img'];
    function getNameAttribute(){
        $lang = app()->getLocale();
        $var = "name_".$lang;
        return $this->$var;
    }
    function getDefinitionAttribute(){
        $lang = app()->getLocale();
        $var = "definition_".$lang;
        return $this->$var;
    }
    function getImgAttribute(){
        $lang = app()->getLocale();
        $var = "img_".$lang;
        return $this->$var;
    }
}
