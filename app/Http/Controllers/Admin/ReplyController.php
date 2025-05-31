<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function index() {
        $ratings = RatingWebsite::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.rating.index', compact('ratings'));
    }

    public function replyForm($id) {
        $rating = RatingWebsite::findOrFail($id);
        return view('admin.rating.reply', compact('rating'));
    }

    public function reply(Request $request, $id) {
        $request->validate([
            'tanggapan_review' => 'required|string|max:1000',
        ]);

        $rating = RatingWebsite::findOrFail($id);
        $rating->tanggapan_review = $request->tanggapan_review;
        $rating->save();

        return redirect()->route('admin.rating.index')->with('success', 'Reply submitted successfully.');
    }

}
