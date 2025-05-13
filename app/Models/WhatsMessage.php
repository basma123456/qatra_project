<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'message',
        'file',
    ];
}
