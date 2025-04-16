<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penukaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PenukaranDiterima;

class PenukaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'riwayat_penukaran' => 'nullable|string|max:1000',
        ]);

        $barangDitawarkan = Barang::findOrFail($request->id_barang_ditawarkan);

        if ($barangDitawarkan->id_user != Auth::user()->id) {
            return redirect()->route('barang.show', $id_barang)->with('error', 'Anda hanya dapat menawarkan barang milik Anda.');
        }

        if ($barangDitawarkan->status_barang != 'tersedia') {
            return redirect()->route('barang.show', $id_barang)->with('error', 'Barang yang Anda tawarkan tidak tersedia.');
        }

        Penukaran::create([
            'id_mahasiswa' => Auth::user()->id,
            'id_barang' => $barang->id_barang,
            'id_barang_ditawarkan' => $barangDitawarkan->id_barang,
            'riwayat_penukaran' => $request->riwayat_penukaran,
            'status_penukaran' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Permintaan tukar barang telah dikirim!');
    }

    public function index()
    {
        $penukaranMasuk = Penukaran::whereHas('barang', function ($query) {
            $query->where('id_user', Auth::user()->id);
        })->with(['barang', 'barangDitawarkan', 'requester'])->get();

        return view('penukaran.index', compact('penukaranMasuk'));
    }

    public function confirm($id_penukaran)
    {
        $penukaran = Penukaran::findOrFail($id_penukaran);

        if ($penukaran->barang->id_user != Auth::user()->id) {
            return redirect()->route('penukaran.index')->with('error', 'Anda tidak memiliki akses untuk mengkonfirmasi permintaan ini.');
        }

        if ($penukaran->status_penukaran != 'pending') {
            return redirect()->route('penukaran.index')->with('error', 'Permintaan ini sudah diproses.');
        }

        $penukaran->update(['status_penukaran' => 'diterima']);

        $penukaran->barang->update(['status_barang' => 'ditukar']);
        $penukaran->barangDitawarkan->update(['status_barang' => 'ditukar']);

        // Notify the requester
        $penukaran->requester->notify(new PenukaranDiterima($penukaran));

        return redirect()->route('penukaran.index')->with('success', 'Permintaan tukar barang telah diterima!');
    }

    public function reject($id_penukaran)
    {
        $penukaran = Penukaran::findOrFail($id_penukaran);

        if ($penukaran->barang->id_user != Auth::user()->id) {
            return redirect()->route('penukaran.index')->with('error', 'Anda tidak memiliki akses untuk menolak permintaan ini.');
        }

        if ($penukaran->status_penukaran != 'pending') {
            return redirect()->route('penukaran.index')->with('error', 'Permintaan ini sudah diproses.');
        }

        $penukaran->update(['status_penukaran' => 'ditolak']);

        return redirect()->route('penukaran.index')->with('success', 'Permintaan tukar barang telah ditolak.');
    }
}