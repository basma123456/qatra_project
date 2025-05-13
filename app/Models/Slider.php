<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'img_ar',
        'img_en',
        'status',
        'url',
        'sort',
        'image',
        'status',
        'created_by',
        'updated_by',
        'title',
        'slug',
        'description',

    ];
    protected $appends = ['img'];

    function getImgAttribute()
    {
        $lang = app()->getLocale();
        $var = "img_" . $lang;
        return $this->$var;
    }


    public function scopeActive($query)
    {
        return $query->where('status' , 1);
    }

    /*******************images part ********************/

    //path of images
    public function path()
    {
        $path = "/attachments/slider/";
        return $path;
    }


    //path of images that showed in view
    public function pathInView()
    {
        if (file_exists(public_path() . $this->path() . $this->image) && $this->image) {
            $path = $this->path() . $this->image;
        } else {
            $path = '/attachments/no_image/no_image.png';
        }
        return $path;
    }


}
