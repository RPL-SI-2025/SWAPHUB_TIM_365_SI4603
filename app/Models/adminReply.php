<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class adminReply extends Model
{
    public function rating() {
    return $this->belongsTo(RatingWebsite::class);
}

public function admin() {
    return $this->belongsTo(User::class, 'admin_id');
}
}
