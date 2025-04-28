<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    protected $table = 'history';
    protected $primaryKey = 'id_history';

    protected $fillable = [
        'id_penukaran_barang',
    ];

        public function penukaran()
    {
        return $this->belongsTo(Penukaran::class, 'id_penukaran_barang', 'id_penukaran');
    }
}
