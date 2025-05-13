<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'description',
            'image',
            'rate',
            'sort',
            'admin_id',
            'status',
            'feature',
            'gender',
        ];


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }


    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /***********scopes*********
     * @param $query
     * @return
     */

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeature($query)
    {
        return $query->where('feature', 1);
    }

    /***********************images *****************/


    public function path()
    {
        return "/attachments/reviews/";
    }

    static public function staticPath()
    {
        return "/attachments/reviews/";
    }

    public function pathInView()
    {
        if ($this->image) {
            return $this->path() . $this->image;
        } elseif ($this->gender === 0 ) {
            return "/attachments/no_images/man_image.png";
        } elseif ($this->gender === 1) {
            return "/attachments/no_images/woman_image.png";
        }
    }

}
