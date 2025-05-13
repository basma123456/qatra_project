<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'mosque_id',
        'user_id',
    ];

    function mosque(){
        return $this->belongsTo(Mosque::class);
    }

    
    function user(){
        return $this->belongsTo(User::class);
    }
}
