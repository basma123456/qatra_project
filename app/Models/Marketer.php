<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPUnit\Framework\Constraint\Count;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;

class Marketer  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, AuthenticationLoggable;
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'browse_code',
        'affiliate_code',
        'email_verified_at',
        'remember_token',
        'marketer_admin_id',

    ];

    protected $guard = 'marketer';

    protected $hidden = [
    'password', 'remember_token',
];

    function coupons(){
        return $this->hasMany(Coupon::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
