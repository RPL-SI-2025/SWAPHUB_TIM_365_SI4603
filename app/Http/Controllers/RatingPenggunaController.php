<?php

namespace App\Http\Controllers;

use App\Models\RatingPengguna;
use Illuminate\Http\Request;
use App\Models\Penukaran;
use Illuminate\Support\Facades\Auth;

class RatingPenggunaController extends Controller
{
    public function index()
    {
        $ratings = RatingPengguna::all();
        return view('rating_pengguna.index', compact('ratings'));
    }

    public function create(Request $request)
    {
        $id_penukaran = $request->query('id_penukaran');
        
        // Cek apakah penukaran sudah dirating
        $existingRating = RatingPengguna::where('id_penukaran_barang', $id_penukaran)->first();
        if ($existingRating) {
            return redirect()->route('history.index')
                           ->with('error', 'Penukaran ini sudah diberi rating sebelumnya.');
        }

        // Cek apakah penukaran ada dan valid
        $penukaran = Penukaran::findOrFail($id_penukaran);
        
        // Cek apakah user adalah bagian dari penukaran ini
        if ($penukaran->id_penawar !== Auth::id() && $penukaran->id_ditawar !== Auth::id()) {
            return redirect()->route('history.index')
                           ->with('error', 'Anda tidak memiliki akses untuk memberi rating pada penukaran ini.');
        }

        return view('rating_pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penukaran_barang' => 'required|exists:penukaran,id_penukaran',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Cek apakah sudah ada rating untuk penukaran ini
        $existingRating = RatingPengguna::where('id_penukaran_barang', $request->id_penukaran_barang)->first();
        if ($existingRating) {
            return redirect()->route('history.index')
                           ->with('error', 'Penukaran ini sudah diberi rating sebelumnya.');
        }

        // Cek apakah user adalah bagian dari penukaran
        $penukaran = Penukaran::findOrFail($request->id_penukaran_barang);
        if ($penukaran->id_penawar !== Auth::id() && $penukaran->id_ditawar !== Auth::id()) {
            return redirect()->route('history.index')
                           ->with('error', 'Anda tidak memiliki akses untuk memberi rating pada penukaran ini.');
        }

        RatingPengguna::create([
            'id_penukaran_barang' => $request->id_penukaran_barang,
            'id_user' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('history.index')
                        ->with('success', 'Rating berhasil ditambahkan.');
    }

    public function show($id)
    {
        $rating = RatingPengguna::findOrFail($id);
        return view('rating_pengguna.show', compact('rating'));
    }

    public function edit($id)
    {
        $rating = RatingPengguna::findOrFail($id);
        
        // Cek apakah user adalah pemberi rating
        if ($rating->id_user !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit rating ini.');
        }
        
        return view('rating_pengguna.edit', compact('rating'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = RatingPengguna::findOrFail($id);
        
        // Cek apakah user adalah pemberi rating
        if ($rating->id_user !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit rating ini.');
        }

        $rating->update([
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('rating_pengguna.index')
                        ->with('success', 'Rating berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rating = RatingPengguna::findOrFail($id);
        
        // Cek apakah user adalah pemberi rating
        if ($rating->id_user !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk menghapus rating ini.');
        }
        
        $rating->delete();

        return redirect()->route('rating_pengguna.index')
                        ->with('success', 'Rating berhasil dihapus!');
    }
}
