<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|numeric|unique:users,phone',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required|string|in:user,admin',
        ]);

        // Simpan gambar jika ada
        $profilePath = null;
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/uploads', $filename);
            $profilePath = 'storage/uploads/' . $filename;
        }

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
            'profile_picture' => $profilePath,
        ]);

        return redirect('/')->with('success', 'Registration success!');;
    }
}
