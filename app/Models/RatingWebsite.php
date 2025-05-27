<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingWebsite extends Model
{
    use HasFactory;

    protected $table = 'rating_websites';
    protected $primaryKey = 'id_rating_website';
    
    protected $fillable = [
        'id_user',
        'review',
        'rating',
        'tanggapan_review'
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Scope untuk mendapatkan rating berdasarkan user
    public function scopeByUser($query, $userId)
    {
        return $query->where('id_user', $userId);
    }

    // Scope untuk mendapatkan rating berdasarkan bintang
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function reply() {
    return $this->hasOne(AdminReply::class);
    }
}