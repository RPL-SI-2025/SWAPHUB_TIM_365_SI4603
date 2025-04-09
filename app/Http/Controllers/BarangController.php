<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::show_item();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,ditukar,dihapus',
        ]);

        Barang::create([
            'id_user' => Auth::user()->id,
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $kategori = Kategori::all();

        if (Auth::user()->id != $barang->id_user && !Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk mengedit barang ini.');
        }

        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        if (Auth::user()->id != $barang->id_user && !Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk mengedit barang ini.');
        }

        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,ditukar,dihapus',
        ]);

        $barang->update([
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        if (Auth::user()->id != $barang->id_user && !Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Anda tidak memiliki akses untuk menghapus barang ini.');
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}