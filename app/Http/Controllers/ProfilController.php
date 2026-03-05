<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nom'              => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $user->id,
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password'         => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'nom'   => $request->nom,
            'email' => $request->email,
        ];

        if ($request->hasFile('photo')) {
            if ($user->photo_url !== 'default_user.jpg') {
                Storage::disk('public')->delete($user->photo_url);
            }
            $data['photo_url'] = $request->file('photo')->store('users', 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profil mis a jour avec succes.');
    }
}