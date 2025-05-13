<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    use HasFactory;


    use HasFactory, SoftDeletes;

    protected $fillable = ['image', 'status', 'created_by',
        'updated_by', 'title', 'slug', 'content',
        'meta_title', 'meta_description',
        'meta_key', 'updated_by', 'created_by',
    ];


    // Scopes ----------------------------
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }



    /*******************images part ********************/

    //path of images
    public function path()
    {
        $path = "/attachments/pages/";
        return $path;
    }


    //path of images that showed in view
    public function pathInView()
    {
        if (file_exists(public_path() . $this->path() .'/' . $this->image) && $this->image) {
            $path = $this->path() . $this->image;
        } else {
            $path = '/attachments/no_images/no_image.png';
        }
        return $path;
    }


}
