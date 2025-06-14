<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'SwapHub Profile';
        $user = Auth::user();
        return view('profile.index', compact('title', 'user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->id !== Auth::id()) {
            return redirect()->route('profile.index')->with('error', 'Unauthorized action.');
        }

        // Validasi request
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // Update data yang tersedia
        if ($request->filled('first_name')) {
            $user->first_name = $request->first_name;
        }

        if ($request->filled('last_name')) {
            $user->last_name = $request->last_name;
        }

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }

        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $filePath = $request->file('profile_picture')->store('photo-profile', 'public');
            $user->profile_picture = $filePath;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}