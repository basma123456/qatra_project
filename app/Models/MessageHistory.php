<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_type_id',
        'user_id',
        'mobile',
        'name',
        'text',
        'status',
        'send_times',
        'last_error',
    ];
}
