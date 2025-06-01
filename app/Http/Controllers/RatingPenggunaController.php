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
        // Ambil semua rating dan load relasinya
        $ratings = RatingPengguna::with(['penukaran.penawar', 'penukaran.ditawar'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('rating_pengguna.index', compact('ratings'));
    }

    public function create(Request $request)
    {
        $id_penukaran = $request->query('id_penukaran');
        
        if (!$id_penukaran) {
            return redirect()->route('history.index')
                           ->with('error', 'ID Penukaran tidak valid.');
        }

        // Cek apakah penukaran ada dan valid
        $penukaran = Penukaran::findOrFail($id_penukaran);
        
        // Tentukan tipe rating berdasarkan role user
        $rating_type = null;
        if ($penukaran->id_penawar === Auth::id()) {
            $rating_type = RatingPengguna::TYPE_PENAWAR;
        } elseif ($penukaran->id_ditawar === Auth::id()) {
            $rating_type = RatingPengguna::TYPE_DITAWAR;
        } else {
            return redirect()->route('history.index')
                           ->with('error', 'Anda tidak memiliki akses untuk memberi rating pada penukaran ini.');
        }

        // Cek apakah user sudah memberikan rating untuk tipe ini
        $existingRating = RatingPengguna::where('id_penukaran_barang', $id_penukaran)
                                       ->where('id_user', Auth::id())
                                       ->where('rating_type', $rating_type)
                                       ->first();

        if ($existingRating) {
            return redirect()->route('rating_pengguna.edit', $existingRating->id_rating_pengguna)
                           ->with('info', 'Anda sudah memberikan rating untuk penukaran ini. Silakan edit rating yang ada.');
        }

        return view('rating_pengguna.create', compact('penukaran', 'rating_type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penukaran_barang' => 'required|exists:penukaran,id_penukaran',
            'review' => 'required|string|min:1',
            'rating' => 'required|integer|min:1|max:5',
            'rating_type' => 'required|in:' . RatingPengguna::TYPE_PENAWAR . ',' . RatingPengguna::TYPE_DITAWAR,
        ]);

        $penukaran = Penukaran::findOrFail($request->id_penukaran_barang);
        
        // Validasi akses berdasarkan tipe rating
        if ($request->rating_type === RatingPengguna::TYPE_PENAWAR && $penukaran->id_penawar !== Auth::id()) {
            return redirect()->route('history.index')
                           ->with('error', 'Anda tidak memiliki akses untuk memberi rating sebagai penawar.');
        }
        
        if ($request->rating_type === RatingPengguna::TYPE_DITAWAR && $penukaran->id_ditawar !== Auth::id()) {
            return redirect()->route('history.index')
                           ->with('error', 'Anda tidak memiliki akses untuk memberi rating sebagai yang ditawar.');
        }

        // Cek apakah sudah ada rating dengan tipe yang sama
        $existingRating = RatingPengguna::where('id_penukaran_barang', $request->id_penukaran_barang)
                                       ->where('id_user', Auth::id())
                                       ->where('rating_type', $request->rating_type)
                                       ->first();

        if ($existingRating) {
            return redirect()->route('rating_pengguna.edit', $existingRating->id_rating_pengguna)
                           ->with('info', 'Anda sudah memberikan rating untuk penukaran ini. Silakan edit rating yang ada.');
        }

        try {
            RatingPengguna::create([
                'id_penukaran_barang' => $request->id_penukaran_barang,
                'id_user' => Auth::id(),
                'rating' => $request->rating,
                'review' => $request->review,
                'rating_type' => $request->rating_type,
            ]);

            return redirect()->route('history.index')
                           ->with('success', 'Rating berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan rating. Silakan coba lagi.')
                        ->withInput();
        }
    }

    public function show($id)
    {
        $rating = RatingPengguna::findOrFail($id);
        return view('rating_pengguna.show', compact('rating'));
    }

    public function edit($id)
    {
        $rating = RatingPengguna::with('penukaran')->findOrFail($id);
        
        // Validasi akses berdasarkan tipe rating
        if ($rating->rating_type === RatingPengguna::TYPE_PENAWAR && $rating->penukaran->id_penawar !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit rating ini.');
        }
        
        if ($rating->rating_type === RatingPengguna::TYPE_DITAWAR && $rating->penukaran->id_ditawar !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit rating ini.');
        }

        return view('rating_pengguna.edit', compact('rating'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string|min:1',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = RatingPengguna::with('penukaran')->findOrFail($id);
        
        // Validasi akses berdasarkan tipe rating
        if ($rating->rating_type === RatingPengguna::TYPE_PENAWAR && $rating->penukaran->id_penawar !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit rating ini.');
        }
        
        if ($rating->rating_type === RatingPengguna::TYPE_DITAWAR && $rating->penukaran->id_ditawar !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk mengedit rating ini.');
        }

        try {
            $rating->update([
                'review' => $request->review,
                'rating' => $request->rating,
                'updated_at' => now()
            ]);

            return redirect()->route('rating_pengguna.index')
                            ->with('success', 'Rating berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui rating. Silakan coba lagi.')
                        ->withInput();
        }
    }

    public function destroy($id)
    {
        $rating = RatingPengguna::with('penukaran')->findOrFail($id);
        
        // Validasi akses berdasarkan tipe rating
        if ($rating->rating_type === RatingPengguna::TYPE_PENAWAR && $rating->penukaran->id_penawar !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk menghapus rating ini.');
        }
        
        if ($rating->rating_type === RatingPengguna::TYPE_DITAWAR && $rating->penukaran->id_ditawar !== Auth::id()) {
            return redirect()->route('rating_pengguna.index')
                           ->with('error', 'Anda tidak memiliki akses untuk menghapus rating ini.');
        }

        try {
            $rating->delete();
            return redirect()->route('rating_pengguna.index')
                            ->with('success', 'Rating berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus rating. Silakan coba lagi.');
        }
    }
}
