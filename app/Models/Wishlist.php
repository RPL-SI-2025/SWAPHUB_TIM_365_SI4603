<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'id_wishlist';

    protected $fillable = [
        "id_user",
        "id_barang"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, "id_barang");
    }
}
