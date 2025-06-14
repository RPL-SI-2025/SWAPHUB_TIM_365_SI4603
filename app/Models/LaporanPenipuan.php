<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'pesan_admin',
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

    public static function countPending()
    {
        return self::where('status_laporan', 'pending')->count();
    }
}
