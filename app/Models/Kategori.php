<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'jenis_kategori',
    ];

    // Metode untuk mendapatkan kategori dengan jenis 'barang'
    public static function getBarangCategories()
    {
        return self::where('jenis_kategori', 'barang')->get();
    }

    // Metode untuk mendapatkan kategori dengan jenis 'laporan'
    public static function getLaporanCategories()
    {
        return self::where('jenis_kategori', 'laporan')->get();
    }
}
