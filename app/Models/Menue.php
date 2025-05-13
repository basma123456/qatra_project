<?php

namespace App\Models;

use App\Enums\MenuPositionEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menue extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'position',
        'sort',
        'url',
        'type',
        'level',
        'dynamic_table',
        'dynamic_url',
        'status',
        'title',
        'slug',
        'created_by',
        'updated_by',
    ];
    // foreign key
//    protected $translationForeignKey = 'menue_id';
    // transatable table
//    public $translatedAttributes = ['menue_id', 'locale', 'title', 'slug'];


//    public function trans(){
//        return $this->hasMany(MenueTranslation::class, 'menue_id', 'id');
//    }

    public function parent(){
        return $this->belongsTo(Menue::class,'parent_id', 'id');
    }
    public function children(){
        return $this->hasMany(Menue::class, 'parent_id', 'id')->orderBy('sort', 'ASC')->active();
    }



    // Scopes ------------------------------------------------
    public function scopeActive($query){
        return $query->where('status', 1);
    }
//app/Enums/MenuPositionEnums.php
    public function scopeMain($query){
        return $query->where('position', MenuPositionEnums::MAIN);
    }
    public function scopeFooter($query){
        return $query->where('position', MenuPositionEnums::FOOTER);
    }
    public function scopeParent($query){
        return $query->where('parent_id', null);
    }


}
