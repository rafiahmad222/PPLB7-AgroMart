<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'google_id',
        'google_token',
        'google_refresh_token',
        'name',
        'email',
        'password',
        'role',
        'avatar_url',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
        'google_refresh_token',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
