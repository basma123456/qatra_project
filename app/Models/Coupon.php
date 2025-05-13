<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketer_id',
        'product_id',
        'status',
        'quantity',
        'code',
    ];

    function marketer(){
        return $this->belongsTo(Marketer::class)->withDefault([
            'name'=>"غير معروف"
        ]);
    }
    function product(){
        return $this->belongsTo(Product::class)->withDefault([
            'name'=>"غير معروف"
        ]);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_products', 'coupon_id', 'product_id');
    }
    
}
