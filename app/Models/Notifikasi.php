<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notifikasi extends Model
{
    protected $primaryKey = 'id_notifikasi';
    protected $table = 'notifikasi';

    protected $fillable = [
        'id_user',
        'is_read',
        'message',
        'url',
    ];

    public static function send($id_user, $message, $url)
    {
        return self::create([
            'id_user' => $id_user,
            'message' => $message,
            'url' => $url,
            'is_read' => false,
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }
}
