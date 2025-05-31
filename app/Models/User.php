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
        'profile_picture',
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

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Check if user is admin
    public function getIsAdminAttribute()
    {
        return $this->role === 'admin';
    }

    // Relasi dengan Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_user', 'id');
    }

    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_user', 'id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'id_user', 'id');
    }

    // Jumlah notifikasi belum dibaca
    public function getUnreadNotificationsCountAttribute()
    {
        return $this->notifikasis()->where('is_read', false)->count();
    }

    // Jumlah wishlist
    public function getWishlistCountAttribute()
    {
        return $this->wishlists()->count();
    }

    // Relasi dengan RekomendasiBarang (user yang menerima rekomendasi)
    public function rekomendasiBarang()
    {
        return $this->hasMany(RekomendasiBarang::class, 'user_id', 'id');
    }

    // Relasi dengan RekomendasiBarang (admin yang memberikan rekomendasi)
    public function rekomendasiAdmin()
    {
        return $this->hasMany(RekomendasiBarang::class, 'id_admin', 'id');
    }

}
