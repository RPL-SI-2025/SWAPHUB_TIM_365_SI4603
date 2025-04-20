<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi (opsional, tapi bagus dilakukan)
    $request->validate([
        'profile_picture_users' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
    ]);

    // Handle upload foto
    if ($request->hasFile('profile_picture_users')) {
        $file = $request->file('profile_picture_users');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // Simpan di storage/app/public/uploads
        $file->storeAs('public/uploads', $filename);

        // Hapus foto lama (jika ada)
        if ($user->profile_picture_users) {
            Storage::delete('public/uploads/' . $user->profile_picture_users);
        }

        // Update nama file di database
        $user->profile_picture_users = $filename;
    }

    // Simpan perubahan
    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}


}
