<?php

namespace App\Http\Controllers;

use App\Models\RatingPengguna;
use Illuminate\Http\Request;

class RatingPenggunaController extends Controller
{
    public function index()
    {
        $ratings = RatingPengguna::all();
        return view('rating_pengguna.index', compact('ratings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penukaran_barang' => 'required|integer',
            'id_user' => 'required|integer',
            'id_rating_pengguna' => 'nullable|integer',
            'review' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = RatingPengguna::create($request->all());
        return response()->json($rating, 201);
    }

    public function show($id)
    {
        $rating = RatingPengguna::findOrFail($id);
        return response()->json($rating);
    }

    public function update(Request $request, $id)
    {
        $rating = RatingPengguna::findOrFail($id);
        $rating->update($request->all());
        return response()->json($rating);
    }

    public function destroy($id)
    {
        $rating = RatingPengguna::findOrFail($id);
        $rating->delete();
        return response()->json(null, 204);
    }
}
