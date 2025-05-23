<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'text',
        'x',
        'y',
        'color',
        'size',
    ];
}
