<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenipuan;
use App\Models\Kategori;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanPenipuanController extends Controller
{
    // Index untuk admin (semua laporan) dan user (hanya laporan mereka sendiri)
    public function index()
    {
        $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->where('id_pelapor', Auth::user()->id)->get();
        return view('laporan_penipuan.index', compact('laporan'));
    }

    // Form untuk membuat laporan (hanya user)
    public function create()
    {
        if (!Auth::user()->is_admin) {
            $kategori = Kategori::where('jenis_kategori', 'laporan')->get();
            $users = User::where('id', '!=', Auth::user()->id)->get();
            return view('laporan_penipuan.create', compact('kategori', 'users'));
        }
        return redirect()->route('laporan_penipuan.index')->with('error', 'Hanya pengguna biasa yang dapat membuat laporan.');
    }

    // Menyimpan laporan baru (hanya user)
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            $request->validate([
                'id_kategori' => 'required|exists:kategori,id_kategori',
                'id_dilapor' => 'required|exists:users,id',
                'pesan_laporan' => 'required|string|max:1000',
                'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $data = $request->all();
            $data['id_pelapor'] = Auth::user()->id;
            $data['status_laporan'] = 'pending';

            if ($request->hasFile('foto_bukti')) {
                $data['foto_bukti'] = $request->file('foto_bukti')->store('foto_bukti', 'public');
            }

            LaporanPenipuan::create($data);

            return redirect()->route('laporan_penipuan.index')->with('success', 'Laporan penipuan telah dikirim!');
        }
        return redirect()->route('laporan_penipuan.index')->with('error', 'Hanya pengguna biasa yang dapat membuat laporan.');
    }

    // Detail laporan (user: milik sendiri, admin: semua)
    public function show($id)
    {
        $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->findOrFail($id);
        if (!Auth::user()->is_admin && $laporan->id_pelapor != Auth::user()->id) {
            return redirect()->route('laporan_penipuan.index')->with('error', 'Anda tidak memiliki akses untuk melihat laporan ini.');
        }
        if (Auth::user()->is_admin) {
            return view('admin.laporan_penipuan.show', compact('laporan'));
        }
        return view('laporan_penipuan.show', compact('laporan'));
    }
}
