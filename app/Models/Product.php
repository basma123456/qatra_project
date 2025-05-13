<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function App\Helpers\getIcon;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name_ar',
        'name_en',
        'img',
        'price',
        'description_ar',
        'description_en',
        'category_id',
        'status',
        'deliverable',
        'taxable',
        'no_carton',
        'sort',
        'feature',
        'slug',
        'meta_description',
        'meta_key',
        'meta_title',

    ];
    protected $appends = ['name', 'description'];

    function getNameAttribute()
    {
        $lang = app()->getLocale();
        $var = "name_" . $lang;
        return $this->$var;
    }

    function getDescriptionAttribute()
    {
        $lang = app()->getLocale();
        $var = "description_" . $lang;
        return $this->$var;
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function mosques()
    {
        return $this->belongsToMany(Mosque::class , 'product_mosques' , 'product_id' , 'mosque_id');
    }
    /*************scopes**************/
    public function scopeFeature($query)
    {
        return $query->where('feature' , 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status' , 1);
    }
    /*********************image path***************************/

//    public function path()
//    {
//        return "/attachments/products/";
//    }
//
//    static public function staticPath()
//    {
//        return "/attachments/products/";
//    }
//
//    public function pathInView()
//    {
//        if ($this->img) {
//            return  $this->path() . $this->img;
//        } else {
//            return "/attachments/no_images/no_image.png";
//        }
//    }

    /**********************/


    public function getFirstPhoto()
    {
      return  is_array(json_decode($this->img , true)) ? asset("storage/" . json_decode($this->img , true)[0]) : getIcon();
    }

}
