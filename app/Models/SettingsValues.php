<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsValues extends Model
{
    use HasFactory;

    protected $fillable = ['setting_id', 'key', 'value', 'type'];

    public function setting(){
        return $this->belongsTo(Settings::class, 'setting_id');
    }

}
