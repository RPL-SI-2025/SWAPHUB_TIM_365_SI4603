<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.users.index', compact('users'));
        
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    public function rekomendasi(User $user)
    {
        $rekomendasi = $user->rekomendasiBarangs()->with('barang')->get();
        $kategori = Kategori::all();

        return view('admin.users.rekomendasi', compact('user', 'rekomendasi', 'kategori'));
    }

}
