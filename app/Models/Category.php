<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'name_ar',
        'name_en',
        'img',
        'description',
        'status',
        'feature', 'sort', 'slug', 'meta_description', 'meta_key', 'meta_title', 'updated_by', 'created_by',
    ];
    protected $appends = ['name'];

    function getNameAttribute()
    {
        $lang = app()->getLocale();
        $var = "name_" . $lang;
        return $this->$var;
    }

    /*************scoopes******
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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function activeProducts()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 1)->orderby('id', 'ASC');
    }
}
