<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'quantity',
        'product_id',
        'order_id',
        'city_id',
        'district_id',
        'mosque_id',
        'coupon',
        'is_gift_card',
        'gift_sender',
        'gift_recipient_name',
        'gift_recipient_mobile',
        'delivery_name',
        'delivery_mobile',
        'delivery_type_id',
        'assigned_at',
        'delivering_at',
        'delivered_at',
        'order_status_id',
    ];

    function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }


    
    function driver_order(){
        return $this->hasOne(DriverOrder::class)->withDefault(['name'=>'غير معروف']);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
    function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }

    public function setDateAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }
    public function getYateAttribute()
    {
        return $this->product()->name_ar;
    }

}
