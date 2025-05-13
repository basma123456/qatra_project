<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMosque extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'mosque_id',
        'qty',

    ];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
