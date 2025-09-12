<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'full_name', 'email', 'phone_number', 'address','image', 'username', 'password', 'role', 'department'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function tireRequests()
    {
        return $this->hasMany(TireRequest::class);
    }

}
