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
        'phone',
    ];

    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'user_id', 'id');
    }
    public function transaksiLayanan()
    {
        return $this->hasMany(TransaksiLayanan::class);
    }
    public function artikels()
    {
        return $this->hasMany(Artikel::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
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
