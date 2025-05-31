<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        $barang = Kategori::where('jenis_kategori', 'barang')->get();
        $laporan = Kategori::where('jenis_kategori', 'laporan')->get();
    
        return view('kategori.index', compact('barang', 'laporan'));
    }
    
    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
            'jenis_kategori' => 'required|in:barang,laporan',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
            'jenis_kategori' => 'required|in:barang,laporan',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
    public function showRecommendationForm()
    {
        // Ambil semua kategori dari tabel kategori
        $kategori = Kategori::all();

        // Ambil data user dan barang (sesuaikan dengan model Anda)
        $users = User::all();
        $barang = Barang::all();

        // Pass data kategori ke view
        return view('admin.recommendation', compact('kategori', 'users', 'barang'));
    }
}