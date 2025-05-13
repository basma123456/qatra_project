<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MosqueType extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];
}
