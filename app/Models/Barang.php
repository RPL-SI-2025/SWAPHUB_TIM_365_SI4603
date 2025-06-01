<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang'; // pastikan ini cocok dengan migration

    protected $fillable = [
        'id_user',
        'id_kategori',
        'nama_barang',
        'deskripsi_barang',
        'status_barang',
        'gambar',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'id_barang');
    }

    public function penukaran(): HasMany
    {
        return $this->hasMany(Penukaran::class, 'id_barang', 'id_barang');
    }

    // Jika kamu menyimpan jumlah klik barang, pastikan ada kolom 'jumlah_klik' di tabel 'barang'
    public function scopePopuler($query)
    {
        return $query->withCount('penukaran')
                     ->orderByDesc('penukaran_count')
                     ->orderByDesc('jumlah_klik');
    }

    public static function show_item()
    {
        return self::with('user')->get();
    }
    public function direkomendasikanUntuk()
    {
        return $this->belongsToMany(User::class, 'rekomendasi_barang', 'id_barang', 'user_id');
    }

}