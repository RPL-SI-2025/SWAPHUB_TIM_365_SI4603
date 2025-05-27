<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminReply;
use App\Models\RatingWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function replyForm($id) {
    $review = RatingWebsite::findOrFail($id);
    return view('admin.reviews.reply', compact('review'));
}

public function store(Request $request, $id) {
    $request->validate([
        'reply_text' => 'required|string',
    ]);

    $review = RatingWebsite::findOrFail($id);

    if ($review->reply) {
        return redirect()->route('admin.reviews.index')->with('error', 'Sudah dibalas.');
    }

    AdminReply::create([
        'rating_id' => $id,
        'admin_id' => auth('admin')->user()->id,
        'reply_text' => $request->reply_text,
    ]);

    return redirect()->route('admin.reviews.index')->with('success', 'Berhasil dibalas.');
}

}
