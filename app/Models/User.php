<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'phone',
        'profile_picture_users',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Periksa apakah user memiliki notifikasi yang belum dibaca
    public function hasUnreadNotifications(): bool
    {
        return $this->notifikasis()->where('is_read', false)->exists();
    }


    // Relasi dengan Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_user', 'id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->First_Name} {$this->Last_Name}";
    }

    // Check if user is admin
    public function getIsAdminAttribute()
    {
        return $this->role === 'admin';
    }

    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_user', 'id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'id_user', 'id');
    }
}
