<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transaction_id',
        'brand',
        'amount',
        'last4',
        'status',
        'description',
        'order_id',
        'ip',
        'device_family',
        'device_model',
        'browser_family',
        'browser_version',
        'platform_family',
        'platform_version',
    ];
}
