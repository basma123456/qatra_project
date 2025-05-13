<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'is_payment',
        'is_gift',
        'status',
        'img',
        'text',
    ];

    function details()
    {
        return $this->hasMany(CardDetail::class);
    }
}
