<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPenipuan;
use App\Models\Kategori;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    // Index untuk admin (semua laporan) dan user (hanya laporan mereka sendiri)
    public function index()
    {
        $title = 'Daftar Laporan Penipuan - SwapHub';
        $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->get();
        return view('admin.laporan_penipuan.index', compact('laporan'));
    }

    // Detail laporan (user: milik sendiri, admin: semua)
    public function show($id)
    {
        $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->findOrFail($id);
        return view('admin.laporan_penipuan.show', compact('laporan'));
    }

    // Ubah status laporan (hanya admin)
    public function updateStatus(Request $request, $id)
    {
        $laporan = LaporanPenipuan::findOrFail($id);
        $request->validate([
            'status_laporan' => 'required|in:pending,diterima,ditolak',
            'pesan_admin' => 'nullable|string|max:1000', // Pesan admin opsional, maksimal 1000 karakter
        ]);

        $data = [
            'status_laporan' => $request->status_laporan,
            'pesan_admin' => $request->pesan_admin, // Simpan pesan untuk semua status
        ];

        $laporan->update($data);

        // Kirim notifikasi ke pelapor jika status berubah ke diterima atau ditolak
        if ($request->status_laporan === 'diterima') {
            Notifikasi::send($laporan->id_pelapor, "Laporan penipuan Anda telah diterima.", "/laporan_penipuan/{$laporan->id_laporan}");
        } elseif ($request->status_laporan === 'ditolak') {
            Notifikasi::send($laporan->id_pelapor, "Laporan penipuan Anda telah ditolak.", "/laporan_penipuan/{$laporan->id_laporan}");
        }

        return redirect()->route('laporan_penipuan.index')->with('success', 'Status laporan telah diperbarui!');
    }
}
