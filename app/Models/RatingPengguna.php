<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingPengguna extends Model
{
    use HasFactory;

    protected $table = 'rating_pengguna';

    protected $fillable = [
        'id_user',
        'id_penukaran_barang',
        'rating',
        'review',
    ];

}
