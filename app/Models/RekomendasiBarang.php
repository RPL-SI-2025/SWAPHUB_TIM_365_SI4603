<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiBarang extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_barang';

    protected $fillable = [
        'id_barang',
        'user_id',  // Mengacu ke pengguna yang menerima rekomendasi
        'id_admin', // Admin yang menambahkan rekomendasi
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
