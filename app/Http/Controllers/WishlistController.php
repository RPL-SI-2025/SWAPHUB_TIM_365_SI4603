<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Notifikasi;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $wishlistItems = Wishlist::with('barang')
            ->where('id_user', $user->id)
            ->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
        ]);

        $user = Auth::user();

        $existingWishlist = Wishlist::where('id_user', $user->id)
            ->where('id_barang', $request->id_barang)
            ->first();

        if ($existingWishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Barang sudah ada di wishlist.'
            ]);
        }

        $barang = Barang::find($request->id_barang);

        Notifikasi::send($request->id_user, "Barang kamu ($barang->nama_barang) ditambahkan ke wishlist oleh $user->first_name", "/barang/$request->id_barang");

        Wishlist::create([
            'id_user' => $user->id,
            'id_barang' => $request->id_barang,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil ditambahkan ke wishlist.'
        ]);
    }


    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $user = Auth::user();

        if ($wishlist->id_user !== $user->id) {
            abort(403);
        }

        $wishlist->delete();

        return redirect()->back()->with('success', 'Barang dihapus dari wishlist.');
    }
}
