<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
        public function index(Request $request)
    {
        $query = History::with([
            'penukaran.penawar',
            'penukaran.ditawar',
            'penukaran.barangPenawar',
            'penukaran.barangDitawar',
        ]);

        $histories = $query->get();

        return view('history.index', compact('histories'));
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
        $history = History::with([
            'penukaran.penawar',
            'penukaran.ditawar',
            'penukaran.barangPenawar',
            'penukaran.barangDitawar',
        ])->findOrFail($id);

        return view('history.show', compact('history'));
    }

}
