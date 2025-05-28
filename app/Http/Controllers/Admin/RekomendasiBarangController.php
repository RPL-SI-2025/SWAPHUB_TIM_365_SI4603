<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\RekomendasiBarang;
use App\Models\Penukaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiBarangController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua barang
        $barang = Barang::all();

        // Ambil semua pengguna
        $users = User::all();

        // Ambil semua rekomendasi yang sudah ada
        $rekomendasi = RekomendasiBarang::with('barang')->get();

        // Ambil riwayat penukaran berdasarkan user_id yang dipilih
        $penukaran = null;
        if ($request->has('user_id')) {
            $penukaran = Penukaran::where('user_id', $request->user_id)->get();
        }

        // Kirim data barang, rekomendasi, users, dan penukaran ke view
        return view('admin.rekomendasi.index', compact('barang', 'rekomendasi', 'users', 'penukaran'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_ids' => 'required|array',
            'barang_ids.*' => 'exists:barang,id_barang',
        ]);

        // Proses untuk menambahkan rekomendasi barang ke pengguna yang dipilih
        foreach ($request->barang_ids as $barang_id) {
            RekomendasiBarang::create([
                'id_barang' => $barang_id,
                'user_id' => $request->user_id,
                'id_admin' => Auth::id(),
            ]);
        }

        return redirect()->route('admin.rekomendasi.index')->with('success', 'Rekomendasi barang berhasil ditambahkan.');
    }
}
