<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'mosque_id',
        'user_id',
        'delivery_type_id',
        'delivery_name',
        'delivery_mobile',
        'payment_id',
        'payment_type_id',
        'order_status_id',
        'assigned_at',
        'delivering_at',
        'delivered_at',
        'amount',
        'total',
        'tax',
        'note',
        'marketer_id',
        'is_gift_card',
        'gift_sender',
        'gift_recipient_name',
        'gift_recipient_mobile',
        'gift_sent_at',
    ];

    function details(){
        return $this->hasMany(OrderDetail::class);
    }
    function images(){
        return $this->hasMany(OrderImage::class);
    }
    function messages(){
        return $this->hasMany(OrderMessage::class);
    }
    function mosque(){
        return $this->belongsTo(Mosque::class)->withDefault(['name_ar'=>'unKnown','name_en'=>'unKnown']);
    }
    function delivery_type(){
        return $this->belongsTo(DeliveryType::class);
    }
    function payment_type(){
        return $this->belongsTo(PaymentType::class)->withDefault(['name_ar'=>'unKnown','name_en'=>'unKnown']);
    }
    function payment(){
        return $this->belongsTo(Payment::class);
    }
    function order_status(){
        return $this->belongsTo(OrderStatus::class);
    }
    function transfer(){
        return $this->hasOne(Transfer::class);
    }
    function user(){
        return $this->belongsTo(User::class)->withDefault(['name'=>'غير معروف']);
    }

    function driver_order(){
        return $this->hasOne(DriverOrder::class)->withDefault(['name'=>'غير معروف']);
    }

    function marketer(){
        return $this->belongsTo(Marketer::class);
    }


}
