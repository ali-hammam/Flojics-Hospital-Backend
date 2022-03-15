<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'is_admin',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function reservations(){
        return $this->hasMany(Reserve::class);
    }
}
