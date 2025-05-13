<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverOrder extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'order_id',
        'order_details_id',
        'user_id',
        'assign_by',
        'driver_status_id',
    ];


    function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    function orderdetails(){
        return $this->belongsTo(OrderDetail::class, 'order_details_id', 'id');
    }
    
}
