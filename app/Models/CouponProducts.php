<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'id', 'coupon_id');
    }


}
