<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:admin,receptionniste,client',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photoUrl = 'default_user.jpg';
        if ($request->hasFile('photo')) {
            $photoUrl = $request->file('photo')->store('users', 'public');
        }

        User::create([
            'nom'       => $request->nom,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'photo_url' => $photoUrl,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur cree avec succes.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom'   => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,receptionniste,client',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'nom'   => $request->nom,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->hasFile('photo')) {
            if ($user->photo_url !== 'default_user.jpg') {
                Storage::disk('public')->delete($user->photo_url);
            }
            $data['photo_url'] = $request->file('photo')->store('users', 'public');
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis a jour.');
    }

    public function destroy(User $user)
    {
        if ($user->photo_url !== 'default_user.jpg') {
            Storage::disk('public')->delete($user->photo_url);
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprime.');
    }

    public function show(User $user)
    {
        $user->load('bookings.room');
        return view('users.show', compact('user'));
    }
}