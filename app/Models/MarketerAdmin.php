<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;

class MarketerAdmin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, AuthenticationLoggable;

    protected $guard = 'marketer_admin';

    protected $fillable = [
        'image',
        'status',
        'name',
        'mobile',
        'email',
        'password',
        'email_verified_at',
        'remember_token',

    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

}
