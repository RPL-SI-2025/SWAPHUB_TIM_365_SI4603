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
        'nama_barang',
        'deskripsi_barang',
        'status_barang',
        'gambar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public static function show_item()
    {
        return self::with('user')->get();
    }
}