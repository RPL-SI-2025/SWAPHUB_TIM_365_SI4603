<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    public function index()
    {
        $title = "Daftar Barang - SwapHub";
        $userId = Auth::id();
        $barang = Barang::where('id_user', $userId)->get();
        return view('barang.index', compact('title', 'barang'));
    }

    public function filter(Request $request)
    {
        $kategoriQuery = $request->query('kategori');
        $searchQuery = $request->query('search');

        $barangQuery = Barang::with('kategori')->where('status_barang', 'tersedia')->where('id_user', '!=', Auth::id());

        if (!empty($kategoriQuery)) {
            $kategori = Kategori::where('nama_kategori', 'like', '%' . $kategoriQuery . '%')->first();

            if ($kategori) {
                $barangQuery->where('id_kategori', $kategori->id_kategori);
            }
        }

        if (!empty($searchQuery)) {
            $barangQuery->where('nama_barang', 'like', '%' . $searchQuery . '%');
        }

        $barang = $barangQuery->get();
        $userId = Auth::id();

        return response()->json([
            'barang' => $barang,
            'user_id' => $userId,
        ]);
    }


    public function create()
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Admin tidak memiliki akses untuk menambah barang.');
        }

        $kategori = Kategori::where('jenis_kategori', 'barang')->get();

        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('barang.index')->with('error', 'Admin tidak memiliki akses untuk menambah barang.');
        }

        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,tidak tersedia',
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

        $barang = Barang::create($data);

        Log::info('Barang baru ditambahkan: ' . $barang->toJson());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id_barang)
    {
        $title = 'Detail Barang - SwapHub';
        $barang = Barang::with('user')->findOrFail($id_barang);
        return view('barang.show', compact('title', 'barang'));
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

        $kategori = Kategori::where('jenis_kategori', 'barang')->get();

        return view('barang.edit', compact('barang', 'kategori'));
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
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'deskripsi_barang' => 'required|string',
            'status_barang' => 'required|in:tersedia,tidak tersedia',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
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

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
