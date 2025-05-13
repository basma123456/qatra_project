<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Driver extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles, HasApiTokens, Notifiable, AuthenticationLoggable;

    protected $guard = 'driver';

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'otp',
        'order_notifications',
        'promotion_notifications',
        'image',
        'status',

    ];

}
