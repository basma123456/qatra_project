<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'account_name',
        'account_no',
        'iban',
        'status',
        'payment_method_id',
        'image',
    ];
    protected $appends = ['name'];

    function getNameAttribute()
    {
        $lang = app()->getLocale();
        $var = "name_" . $lang;
        return $this->$var;
    }
}
