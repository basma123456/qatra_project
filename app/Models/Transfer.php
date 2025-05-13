<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'order_id',
        'amount',
        'bank_id',
        'transfer_img',
        'status',
    ];

    function order(){
        return $this->belongsTo(Order::class);
    }

    function bank(){
        return $this->belongsTo(Bank::class);
    }

    function status(){
        if($this->status==1){
            $row = [
                'title'=>'مفعل',
                'badge'=>'bg-label-primary'
            ];
            
            return $row;
        }else{
            $row = [
                'title'=>'في الانتظار',
                'badge'=>'bg-label-warning'
            ];
            return $row;
        }
    }
}
