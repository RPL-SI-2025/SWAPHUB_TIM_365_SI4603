<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::show_item();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        // Hanya mahasiswa (bukan admin) yang bisa menambah barang
        if (Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Admin tidak memiliki akses untuk menambah barang.');
        }

        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Hanya mahasiswa (bukan admin) yang bisa menambah barang
        if (Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Admin tidak memiliki akses untuk menambah barang.');
        }

        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,ditukar,dihapus',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'id_user' => Auth::user()->id,
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
        ];

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('barang', 'public');
            $data['gambar'] = $gambarPath;
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        // Hanya pemilik barang (mahasiswa) yang bisa mengedit barang
        if (Auth::user()->id != $barang->id_user) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk mengedit barang ini.');
        }

        $kategori = Kategori::all();
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        // Hanya pemilik barang (mahasiswa) yang bisa mengedit barang
        if (Auth::user()->id != $barang->id_user) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk mengedit barang ini.');
        }

        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,ditukar,dihapus',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
        ];

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $gambarPath = $request->file('gambar')->store('barang', 'public');
            $data['gambar'] = $gambarPath;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        // Hanya pemilik barang (mahasiswa) yang bisa menghapus barang
        if (Auth::user()->id != $barang->id_user) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk menghapus barang ini.');
        }

        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}