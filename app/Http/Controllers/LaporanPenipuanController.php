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
        if (Auth::user()->is_admin) {
            $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->get();
            return view('admin.laporan_penipuan.index', compact('laporan'));
        } else {
            $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->where('id_pelapor', Auth::user()->id)->get();
            return view('laporan_penipuan.index', compact('laporan'));
        }
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

            return redirect()->route('home')->with('success', 'Laporan penipuan telah dikirim!');
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

    // Form edit laporan (tidak digunakan lagi karena tidak boleh edit)
    public function edit($id)
    {
        return redirect()->route('laporan_penipuan.index')->with('error', 'Laporan tidak dapat diedit karena bersifat sebagai bukti.');
    }

    // Update laporan (tidak digunakan lagi karena tidak boleh edit)
    public function update(Request $request, $id)
    {
        return redirect()->route('laporan_penipuan.index')->with('error', 'Laporan tidak dapat diedit karena bersifat sebagai bukti.');
    }

    // Hapus laporan (tidak digunakan lagi karena tidak boleh hapus)
    public function destroy($id)
    {
        return redirect()->route('laporan_penipuan.index')->with('error', 'Laporan tidak dapat dihapus karena bersifat sebagai bukti.');
    }

    // Ubah status laporan (hanya admin)
    public function updateStatus(Request $request, $id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('laporan_penipuan.index')->with('error', 'Hanya admin yang dapat mengubah status laporan.');
        }

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