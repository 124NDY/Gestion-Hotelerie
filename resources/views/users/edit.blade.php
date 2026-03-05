@extends('layouts.app')

@section('title', 'Modifier utilisateur')
@section('page-title', 'Modifier un Utilisateur')

@section('content')

<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow p-8">

    <div class="flex items-center gap-4 mb-8">
        <img src="{{ $user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $user->photo_url) }}"
             class="w-16 h-16 rounded-full object-cover border-2 border-yellow-400" alt="">
        <div>
            <p class="font-semibold text-gray-800 dark:text-white">{{ $user->nom }}</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom complet</label>
            <input type="text" name="nom" value="{{ old('nom', $user->nom) }}"
                   class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
            <select name="role" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>Client</option>
                <option value="receptionniste" {{ old('role', $user->role) === 'receptionniste' ? 'selected' : '' }}>Receptionniste</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Changer la photo (optionnel)</label>
            <input type="file" name="photo" accept="image/*"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-yellow-400 file:text-gray-900 file:font-semibold hover:file:bg-yellow-500">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 rounded-lg transition">
                Mettre a jour
            </button>
            <a href="{{ route('users.index') }}"
               class="flex-1 text-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 py-2 rounded-lg transition">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection