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
    $users = User::where('role', '!=', 'admin')->get();
    $histories = collect();
    $kategori = collect();
    $items = collect();
    $selectedUserId = $request->user_id ?? null;
    $selectedCategoryFilter = $request->category_filter ?? null;

    // Ambil rekomendasi barang untuk user terpilih
    $rekomendasiQuery = RekomendasiBarang::with('barang');
    if ($selectedUserId) {
        $rekomendasiQuery->where('user_id', $selectedUserId);
    }
    $rekomendasi = $rekomendasiQuery->get();

    if ($selectedUserId) {
        $histories = History::with([
            'penukaran.penawar',
            'penukaran.ditawar',
            'penukaran.barangPenawar.kategori',
            'penukaran.barangDitawar.kategori',
        ])->whereHas('penukaran', function ($query) use ($selectedUserId) {
            $query->where('id_penawar', $selectedUserId)
                  ->orWhere('id_ditawar', $selectedUserId);
        })->get();

        // Ambil id barang yang sudah pernah ditukar (baik sebagai penawar atau ditawar)
        $barangDitukarIds = $histories->flatMap(function($history) {
            return [
                optional($history->penukaran->barangPenawar)->id_barang,
                optional($history->penukaran->barangDitawar)->id_barang,
            ];
        })->filter()->unique()->toArray();

        // Ambil id barang yang sudah direkomendasikan
        $barangDirekomendasikanIds = $rekomendasi->pluck('id_barang')->toArray();

        // Gabungkan semua id barang yang harus dikecualikan
        $excludeBarangIds = array_merge($barangDitukarIds, $barangDirekomendasikanIds);

        // Ambil semua kategori yang relevan
        $categoryIds = $histories->map(function ($history) {
            return optional($history->penukaran->barangPenawar->kategori)->id_kategori;
        })->filter()->unique();

        $kategori = Kategori::whereIn('id_kategori', $categoryIds)->get();

        // Query barang yang bisa direkomendasikan, kecuali yang sudah ditukar dan sudah direkomendasikan
        $barangQuery = Barang::query();

        // Filter kategori jika ada filter yang dipilih
        if ($selectedCategoryFilter) {
            $barangQuery->where('id_kategori', $selectedCategoryFilter);
        } else {
            $barangQuery->whereIn('id_kategori', $categoryIds);
        }

        if (!empty($excludeBarangIds)) {
            $barangQuery->whereNotIn('id_barang', $excludeBarangIds);
        }

        $items = $barangQuery->get();
    }

    return view('admin.rekomendasi.index', compact(
        'users', 'histories', 'kategori', 'items', 'rekomendasi',
        'selectedUserId', 'selectedCategoryFilter'
    ));
}


private function getCategoriesFromHistory($histories)
{
    $categoryIds = $histories->map(function ($history) {
        // Cek jika penukaran dan kategori tersedia agar tidak error
        return optional($history->penukaran->barangPenawar->kategori)->id_kategori;
    })->filter()->unique();

    return $categoryIds;
}


    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'barang_ids' => 'required|array',
        'barang_ids.*' => 'exists:barang,id_barang',
    ]);

    foreach ($request->barang_ids as $barang_id) {
        RekomendasiBarang::create([
            'id_barang' => $barang_id,
            'user_id' => $request->user_id,
            'id_admin' => Auth::id(),
        ]);
    }

    return redirect()->route('admin.rekomendasi.index', ['user_id' => $request->user_id])
        ->with('success', 'Rekomendasi barang berhasil ditambahkan.');
}

    public function getItemsByCategories(Request $request)
{
    $items = Barang::whereIn('id_kategori', $request->kategori_ids)
        ->where('id_user', '!=', $request->user_id)
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
public function destroy($id)
{
    $rekomendasi = RekomendasiBarang::findOrFail($id);
    $rekomendasi->delete();

    return redirect()->route('admin.rekomendasi.index', ['user_id' => $rekomendasi->user_id])
                     ->with('success', 'Rekomendasi barang berhasil dihapus.');
}
}