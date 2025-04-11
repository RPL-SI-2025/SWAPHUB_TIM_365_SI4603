<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'First_Name',
        'Last_Name',
        'email',
        'password',
        'role',
        'phone_users',
        'profile_picture_users',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

public function barang()
{
    return $this->hasMany(Barang::class, 'id_user', 'id');
}
}
