<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'image',
        'logo',
        'status',
        'feature',
        'title',
        'description',
//        'content',
        'slug',
        'meta_title',
        'meta_description',
        'meta_key',
        'bg_color',
        'link',
        'show_logo_status',
    ];


    // Scopes ----------------------------
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeature($query)
    {
        return $query->where('feature', 1);
    }


    /*******************images part ********************/

    //path of images
    public function path()
    {
        $path = "/attachments/ads/images/";
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
/********************************/

    //path of images
    public function pathLogo()
    {
        $path = "/attachments/ads/logos/";
        return $path;
    }


    //path of images that showed in view
    public function getLogo()
    {
        if (file_exists(public_path() . $this->pathLogo() .'/' . $this->logo) && $this->logo) {
            $path = $this->pathLogo() . $this->logo;
        } else {
            $path = '/attachments/no_images/no_image.png';
        }
        return $path;
    }

}
