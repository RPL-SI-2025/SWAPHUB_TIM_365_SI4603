<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penukaran;

class RatingPengguna extends Model
{
    use HasFactory;

    public function penukaran()
    {
        return $this->belongsTo(Penukaran::class, 'id_penukaran_barang', 'id_penukaran');
    }

    protected $table = 'rating_pengguna';
    protected $primaryKey = 'id_rating_pengguna'; // ⬅️ WAJIB

    public $incrementing = false; // opsional, tergantung apakah PK kamu auto-increment
    protected $keyType = 'int';   // atau 'string' kalau bukan integer

    protected $with = ['penukaran.penawar', 'penukaran.ditawar', 'penukaran.barangPenawar.kategori', 'penukaran.barangDitawar.kategori'];

    protected $fillable = [
        'id_rating_pengguna', 'id_user', 'id_penukaran_barang', 'review', 'rating', 'rating_type'
    ];

    // Konstanta untuk tipe rating
    const TYPE_PENAWAR = 'penawar';
    const TYPE_DITAWAR = 'ditawar';
}


