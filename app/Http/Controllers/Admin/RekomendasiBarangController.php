<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\RekomendasiBarang;
use App\Models\History;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiBarangController extends Controller
{
   public function index(Request $request)
{
    $users = User::where('role', '!=', 'admin')->get();  // Exclude admin
    $histories = null;
    $kategori = [];
    $rekomendasi = RekomendasiBarang::with('barang')->get();
    $barang = []; // Initialize barang as an empty array by default

    // If a user is selected, fetch history and categories based on the user's history
    if ($request->has('user_id') && $request->user_id != '') {
        // Fetch user's transaction history
        $histories = History::with(['penukaran.penawar', 'penukaran.ditawar', 'penukaran.barangPenawar', 'penukaran.barangDitawar'])
            ->whereHas('penukaran', function ($query) use ($request) {
                $query->where('id_penawar', $request->user_id)
                      ->orWhere('id_ditawar', $request->user_id);
            })
            ->get();

        // Get categories based on the user's history
        $kategori = Kategori::whereIn('id_kategori', $this->getCategoriesFromHistory($histories))->get();

        // Fetch the items based on the selected categories
        $barang = Barang::whereIn('id_kategori', $request->kategori_ids) // Select based on selected categories
                        ->where('user_id', '!=', $request->user_id) // Exclude selected user's items
                        ->get();
    }

    // If the request is via AJAX, return JSON response
    if ($request->ajax()) {
        return response()->json([
            'items' => view('admin.rekomendasi.barang_items', compact('barang'))->render(),
        ]);
    }

    // Return the view with required data
    return view('admin.rekomendasi.index', compact('users', 'histories', 'kategori', 'rekomendasi', 'barang'));
}


    private function getCategoriesFromHistory($histories)
    {
        // Collect all categories the user has interacted with
        $categoryIds = $histories->map(function ($history) {
            return $history->penukaran->barangPenawar->kategori->id_kategori;
        });

        return $categoryIds->unique();
    }

    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_ids' => 'required|array',
            'barang_ids.*' => 'exists:barang,id_barang',
        ]);

        // Store recommendations for the selected user
        foreach ($request->barang_ids as $barang_id) {
            RekomendasiBarang::create([
                'id_barang' => $barang_id,
                'user_id' => $request->user_id,
                'id_admin' => Auth::id(),
            ]);
        }

        return redirect()->route('admin.rekomendasi.index')->with('success', 'Rekomendasi barang berhasil ditambahkan.');
    }

    public function getItemsByCategories(Request $request)
    {
        // Fetch items based on selected category IDs and exclude the selected user
        $items = Barang::whereIn('id_kategori', $request->kategori_ids)
            ->where('user_id', '!=', $request->user_id)
            ->get();

        return response()->json([
            'items' => view('admin.rekomendasi.barang_items', compact('items'))->render(),
        ]);
    }

    public function showRecommendationForm(Request $request)
{
    // Fetch all categories
    $kategori = Kategori::all();

    // Fetch users excluding admin
    $users = User::where('role', '!=', 'admin')->get();

    // Fetch items based on selected category (if category is selected)
    $barang = collect();  // Default empty collection

    if ($request->has('category_id') && $request->category_id != '') {
        // Fetch items based on the selected category
        $barang = Barang::where('user_id', '!=', $request->user_id) // Exclude selected user's items
            ->where('id_kategori', $request->category_id)
            ->get();
    }

    // Pass data to the view
    return view('admin.rekomendasi.index', compact('kategori', 'users', 'barang'));
}
}