<?php

namespace App\Models;

//use Database\Factories\UserFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_id',
        'handle_social',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute(): bool
    {
        return $this->attributes['is_admin'];
    }

    public function getIsSuperAdminAttribute(): bool
    {
        return false;
    }

    // return all the posts which are written by this user
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function getAvatarAttribute()
    {
        return true;
    }

}
