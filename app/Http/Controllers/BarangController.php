<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barang = Barang::show_item();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Admin tidak memiliki akses untuk menambah barang.');
        }

        return view('barang.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Admin tidak memiliki akses untuk menambah barang.');
        }

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,tidak tersedia',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_gift' => 'required|boolean',
            'kategori' => 'required|in:Fashion,Outfits,Automotive,Accessories,Stationery,Books,Furniture,Decoration',
        ]);

        $data = [
            'id_user' => Auth::user()->id,
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
            'is_gift' => $request->is_gift,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('barang', 'public');
            $data['gambar'] = $gambarPath;
        }

        $barang = Barang::create($data);

        Log::info('Barang baru ditambahkan: ' . $barang->toJson());

        return redirect()->route('home')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id_barang)
    {
        $barang = Barang::with('user')->findOrFail($id_barang);
        return view('barang.show', compact('barang'));
    }

    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        if (Auth::user()->id != $barang->id_user) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk mengedit barang ini.');
        }

        if ($barang->status_barang == 'ditukar') {
            return redirect()->route('barang.index')->with('error', 'Barang ini sudah ditukar dan tidak dapat diubah.');
        }

        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        if (Auth::user()->id != $barang->id_user) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk mengedit barang ini.');
        }

        if ($barang->status_barang == 'ditukar') {
            return redirect()->route('barang.index')->with('error', 'Barang ini sudah ditukar dan tidak dapat diubah.');
        }

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,tidak tersedia',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_gift' => 'required|boolean',
            'kategori' => 'required|in:Fashion,Outfits,Automotive,Accessories,Stationery,Books,Furniture,Decoration',
        ]);

        $data = [
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
            'is_gift' => $request->is_gift,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $gambarPath = $request->file('gambar')->store('barang', 'public');
            $data['gambar'] = $gambarPath;
        }

        $barang->update($data);

        return redirect()->route('home')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        if (Auth::user()->id != $barang->id_user) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk menghapus barang ini.');
        }

        if ($barang->status_barang == 'ditukar') {
            return redirect()->route('barang.index')->with('error', 'Barang ini sudah ditukar dan tidak dapat dihapus.');
        }

        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('home')->with('success', 'Barang berhasil dihapus!');
    }
}