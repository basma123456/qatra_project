<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'sms',
        'whats',
        'variables',
        'message_type_id',
        'status',
    ];

    function message_type(){
        return $this->belongsTo(MessageType::class);
    }
}
