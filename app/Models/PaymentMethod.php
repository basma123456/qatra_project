<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    protected $table = 'payment_methods';
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'minimum_price',
        'payment_key',
        'image',
        'available_in_cart',
        'status',
        'created_by',
        'updated_by',
    ];


    protected $casts = [
        'minimum_price' => 'decimal:2',
        'available_in_cart' => 'boolean',
        'status' => 'boolean',
    ];


    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeAvailable_in_cart($query)
    {
        return $query->where('available_in_cart', true);
    }


    public function banks()
    {
        return $this->hasMany(Bank::class , 'payment_method_id');
    }
}
