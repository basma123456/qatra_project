<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'order_details_id',
        'approved_at',
        'approved_by',
        'message'
    ];

    function user(){
        return $this->belongsTo(User::class)->withDefault(['name'=>'غير معروف']);
    }
    function order(){
        return $this->belongsTo(Order::class);
    }
}
