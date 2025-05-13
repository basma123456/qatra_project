<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, AuthenticationLoggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'otp',
        'fcm',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'email_verified_at',
        'otp',
        'remember_token',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function favorites()
    {
        return $this->hasManyThrough(Mosque::class, Favorite::class, 'user_id', 'id', "id", 'mosque_id');
    }

    public function favoriteMosques()
    {
        return $this->belongsToMany(Mosque::class, 'favorites');
    }


    /*********************image path***************************/

    public function path($type)
    {
        return "/attachments/" . $type;
    }

    static public function staticPath($type)
    {
        return "/attachments/" . $type;
    }

    public function pathInView($type)
    {
        if ($this->image) {
            return  $this->path($type) . '/' . $this->image;
        } else {
            return "/attachments/no_images/no_image.png";
        }
    }
}
