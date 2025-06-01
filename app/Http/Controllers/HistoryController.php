<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Riwayat Penukaran';

        $query = History::with([
            'penukaran.penawar',
            'penukaran.ditawar',
            'penukaran.barangPenawar',
            'penukaran.barangDitawar',
        ]);
                
        $categories = Kategori::where('jenis_kategori', 'barang')->get();

        $histories = $query->get();

        return view('history.index', compact('title', 'histories', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penukaran' => 'required|exists:penukaran,id_penukaran',
        ]);

        History::create($validated);

        return redirect()->route('history.index')->with('success', 'Riwayat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $title = 'Detail Riwayat Penukaran';

        $history = History::with([
            'penukaran.penawar',
            'penukaran.ditawar',
            'penukaran.barangPenawar',
            'penukaran.barangDitawar',
        ])->findOrFail($id);

        return view('history.show', compact('title', 'history'));
    }
}
