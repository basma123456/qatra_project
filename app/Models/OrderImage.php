<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'order_details_id',
        'approved_at',
        'approved_by',
        'img'
    ];

    function user(){
        return $this->belongsTo(User::class)->withDefault(['name'=>'غير معروف']);
    }

    
}
