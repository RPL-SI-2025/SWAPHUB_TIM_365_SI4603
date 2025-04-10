<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'id_user', 
        'id_kategori',
        'nama_barang',
        'deskripsi_barang',
        'status_barang',
        'gambar'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Method untuk menampilkan barang
    public static function show_item()
    {
        return self::with(['user', 'kategori'])
            ->where('status_barang', 'tersedia')
            ->get();
    }
}