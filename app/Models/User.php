<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

// Relasi dengan Barang
public function barang()
{
    return $this->hasMany(Barang::class, 'id_user', 'id');
}
}
