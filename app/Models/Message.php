<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'subject',
        'text',
        'ip',
        'device_family',
        'device_model',
        'browser_family',
        'browser_version',
        'platform_family',
        'platform_version',
    ];

}
