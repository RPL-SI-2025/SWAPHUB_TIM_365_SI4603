<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanPenipuan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penipuan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_kategori',
        'id_pelapor',
        'id_dilapor',
        'pesan_laporan',
        'foto_bukti',
        'status_laporan',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'id_pelapor');
    }

    public function dilapor()
    {
        return $this->belongsTo(User::class, 'id_dilapor');
    }
}
