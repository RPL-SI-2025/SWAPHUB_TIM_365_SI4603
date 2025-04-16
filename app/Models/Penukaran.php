<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penukaran extends Model
{
    use HasFactory;

    protected $table = 'penukaran';
    protected $primaryKey = 'id_penukaran';

    protected $fillable = [
        'id_mahasiswa',
        'id_barang',
        'id_barang_ditawarkan',
        'riwayat_penukaran',
        'status_penukaran',
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function barangDitawarkan()
    {
        return $this->belongsTo(Barang::class, 'id_barang_ditawarkan', 'id_barang');
    }
}