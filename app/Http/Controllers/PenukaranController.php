<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penukaran;
use App\Models\History;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenukaranController extends Controller
{
    public function create($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        if (Auth::user()->id == $barang->id_user) {
            return redirect()->route('barang.show', $id_barang)->with('error', 'Anda tidak dapat meminta tukar barang milik Anda sendiri.');
        }

        if ($barang->status_barang != 'tersedia') {
            return redirect()->route('barang.show', $id_barang)->with('error', 'Barang ini tidak tersedia untuk ditukar.');
        }

        $userBarang = Barang::where('id_user', Auth::user()->id)
            ->where('status_barang', 'tersedia')
            ->get();

        return view('penukaran.create', compact('barang', 'userBarang'));
    }

    public function store(Request $request, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
    
        if (Auth::user()->id == $barang->id_user) {
            return redirect()->route('barang.show', $id_barang)->with('error', 'Anda tidak dapat meminta tukar barang milik Anda sendiri.');
        }
    
        $request->validate([
            'id_barang_ditawarkan' => 'required|exists:barang,id_barang',
            'pesan_penukaran' => 'nullable|string|max:1000',
        ]);
    
        $barangDitawarkan = Barang::findOrFail($request->id_barang_ditawarkan);
    
        if ($barangDitawarkan->id_user != Auth::user()->id) {
            return redirect()->route('barang.show', $id_barang)->with('error', 'Anda hanya dapat menawarkan barang milik Anda.');
        }
    
        if ($barangDitawarkan->status_barang != 'tersedia') {
            return redirect()->route('barang.show', $id_barang)->with('error', 'Barang yang Anda tawarkan tidak tersedia.');
        }
    
        // Pengecekan duplikat
        $existingRequest = Penukaran::where('id_penawar', Auth::user()->id)
                                  ->where('id_ditawar', $barang->id_user)
                                  ->where('id_barang_penawar', $barangDitawarkan->id_barang)
                                  ->where('id_barang_ditawar', $barang->id_barang)
                                  ->where('status_penukaran', 'pending')
                                  ->exists();
    
        if ($existingRequest) {
            return redirect()->route('home')->with('error', 'Permintaan tukar untuk kombinasi ini sudah ada.');
        }
    
        Penukaran::create([
            'id_penawar' => Auth::user()->id,
            'id_ditawar' => $barang->id_user,
            'id_barang_penawar' => $barangDitawarkan->id_barang,
            'id_barang_ditawar' => $barang->id_barang,
            'pesan_penukaran' => $request->pesan_penukaran,
            'status_penukaran' => 'pending',
        ]);
    
        return redirect()->route('home')->with('success', 'Permintaan tukar barang telah dikirim!');
    }

    public function index()
    {
        // Permintaan masuk: Barang milik user yang diminta oleh orang lain
        $permintaanMasuk = Penukaran::where('id_ditawar', Auth::user()->id)
            ->with(['barangPenawar', 'barangDitawar', 'penawar', 'ditawar'])
            ->get();

        // Penawaran keluar: Penawaran yang diajukan oleh user
        $penawaranKeluar = Penukaran::where('id_penawar', Auth::user()->id)
            ->with(['barangPenawar', 'barangDitawar', 'penawar', 'ditawar'])
            ->get();

        return view('penukaran.index', compact('permintaanMasuk', 'penawaranKeluar'));
    }

    public function confirm($id_penukaran)
    {
        $penukaran = Penukaran::findOrFail($id_penukaran);

        if ($penukaran->id_ditawar != Auth::user()->id) {
            return redirect()->route('penukaran.index')->with('error', 'Anda tidak memiliki akses untuk mengkonfirmasi permintaan ini.');
        }

        if ($penukaran->status_penukaran != 'pending') {
            return redirect()->route('penukaran.index')->with('error', 'Permintaan ini sudah diproses.');
        }

        $penukaran->update(['status_penukaran' => 'diterima']);

        $penukaran->barangPenawar->update(['status_barang' => 'ditukar']);
        $penukaran->barangDitawar->update(['status_barang' => 'ditukar']);

        // Notifikasi untuk penawar
        Notifikasi::send(
            $penukaran->id_penawar,
            'Permintaan tukar barang Anda untuk "' . $penukaran->barangDitawar->nama_barang . '" telah diterima oleh ' . $penukaran->ditawar->full_name . '.',
            route('penukaran.index')
        );

        // Notifikasi untuk yang ditawar
        Notifikasi::send(
            $penukaran->id_penawar,
            'Anda telah menerima penawaran tukar barang "' . $penukaran->barangPenawar->nama_barang . '" dari ' . $penukaran->penawar->full_name . '.',
            route('penukaran.index')
        );

        History::create([
            'id_penukaran' => $penukaran->id_penukaran,
        ]);

        return redirect()->route('penukaran.index')->with('success', 'Permintaan tukar barang telah diterima!');
    }

    public function reject($id_penukaran)
    {
        $penukaran = Penukaran::findOrFail($id_penukaran);

        if ($penukaran->id_ditawar != Auth::user()->id) {
            return redirect()->route('penukaran.index')->with('error', 'Anda tidak memiliki akses untuk menolak permintaan ini.');
        }

        if ($penukaran->status_penukaran != 'pending') {
            return redirect()->route('penukaran.index')->with('error', 'Permintaan ini sudah diproses.');
        }

        $penukaran->update(['status_penukaran' => 'ditolak']);

        // Notifikasi untuk penawar
        Notifikasi::send(
            $penukaran->id_penawar,
            'Permintaan tukar barang Anda untuk "' . $penukaran->barangDitawar->nama_barang . '" telah ditolak oleh ' . $penukaran->ditawar->full_name . '.',
            route('penukaran.index')
        );

        return redirect()->route('penukaran.index')->with('success', 'Permintaan tukar barang telah ditolak.');
    }

    public function detail($id)
    {
        $penukaran = Penukaran::with([
            'barangPenawar.user',
            'barangDitawar.user'
        ])->findOrFail($id);

        return view('penukaran.detail', compact('penukaran'));
    }
}
