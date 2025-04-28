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
        'id_penawar',
        'id_ditawar',
        'id_barang_penawar',
        'id_barang_ditawar',
        'pesan_penukaran',
        'status_penukaran',
    ];

    public function penawar()
    {
        return $this->belongsTo(User::class, 'id_penawar', 'id');
    }

    public function ditawar()
    {
        return $this->belongsTo(User::class, 'id_ditawar', 'id');
    }

    public function barangPenawar()
    {
        return $this->belongsTo(Barang::class, 'id_barang_penawar', 'id_barang');
    }

    public function barangDitawar()
    {
        return $this->belongsTo(Barang::class, 'id_barang_ditawar', 'id_barang');
    }
}