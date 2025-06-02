<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\RekomendasiBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Barang yang sudah ditukar (status_barang = 'ditukar')
        $barangDitukarIds = Barang::where('id_user', $userId)
            ->where('status_barang', 'ditukar')
            ->pluck('id_barang');

        // Barang yang sudah direkomendasikan untuk user ini
        $barangDirekomendasikanIds = RekomendasiBarang::where('user_id', $userId)
            ->pluck('id_barang');

        // Barang yang masih bisa direkomendasikan (belum ditukar dan belum direkomendasikan)
        $barang = Barang::where('id_user', '!=', $userId)
            ->whereNotIn('id_barang', $barangDitukarIds)
            ->whereNotIn('id_barang', $barangDirekomendasikanIds)
            ->get();

        // Barang yang sudah direkomendasikan untuk ditampilkan
        $barangRekomendasi = Barang::whereIn('id_barang', $barangDirekomendasikanIds)->get();

        return view('home', compact('barang', 'barangRekomendasi'));
    }
}
