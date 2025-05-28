<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
        
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
        'role' => 'nullable|string',
        'status' => 'nullable|string',
        ]);

        $user->update([
        'role' => $validated['role'] ?? $user->role,
        'status' => $validated['status'] ?? $user->status,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
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
