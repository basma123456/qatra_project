<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MosqueImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'mosque_id',
        'img',
        'status',
    ];
}
