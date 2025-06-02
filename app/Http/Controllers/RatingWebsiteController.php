<?php

namespace App\Http\Controllers;

use App\Models\RatingWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RatingWebsiteController extends Controller
{
    /**
     * Store a new rating
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        // Check if user already has a rating
        $existingRating = RatingWebsite::byUser(Auth::id())->first();

        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already submitted a rating. You can edit your existing rating.')->withFragment('rating');;
        }

        RatingWebsite::create([
            'id_user' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->review,
            'is_visible' => $request->has('is_visible'),
            'tanggapan_review' => null
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!')->withFragment('rating');;
    }

    /**
     * Update an existing rating
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $rating = RatingWebsite::where('id_rating_website', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $rating->update([
            'rating' => $request->rating,
            'review' => $request->review,
            'is_visible' => $request->has('is_visible'),
        ]);

        return redirect()->back()->with('success', 'Your rating has been updated successfully!')->withFragment('rating');;
    }

    /**
     * Delete a rating
     */
    public function destroy($id)
    {
        $rating = RatingWebsite::where('id_rating_website', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $rating->delete();

        return redirect()->back()->with('success', 'Your rating has been deleted successfully!')->withFragment('rating');;
    }
}
