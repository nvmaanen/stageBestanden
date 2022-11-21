<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
