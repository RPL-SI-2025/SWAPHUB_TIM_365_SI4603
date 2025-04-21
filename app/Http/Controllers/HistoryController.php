<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = History::with([
            'penukaran_barang.user',
            'penukaran_barang.barang_penawar',
            'penukaran_barang.barang_ditawar'
        ]);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $histories = $query->get();

        return view('history.index', compact('histories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penukaran_barang' => 'required|exists:penukaran_barang,id_penukaran_barang',
        ]);

        History::create($validated);

        return redirect()->route('history.index')->with('success', 'Riwayat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $history = History::with([
            'penukaran_barang.user',
            'penukaran_barang.barang_penawar',
            'penukaran_barang.barang_ditawar',
        ])->findOrFail($id);

        return view('history.show', compact('history'));
    }

}
