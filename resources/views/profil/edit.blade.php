@extends('layouts.app')

@section('title', 'Mon Profil')
@section('page-title', 'Mon Profil')

@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    <!-- Photo et infos -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 flex items-center gap-6">
        <div class="relative">
            <img src="{{ $user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $user->photo_url) }}"
                 class="w-24 h-24 rounded-full object-cover border-4 border-yellow-400"
                 id="photo-preview" alt="Photo profil">
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $user->nom }}</h2>
            <p class="text-gray-500">{{ $user->email }}</p>
            <span class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-medium
                @if($user->role === 'admin') bg-purple-100 text-purple-700
                @elseif($user->role === 'receptionniste') bg-blue-100 text-blue-700
                @else bg-gray-100 text-gray-700 @endif">
                {{ ucfirst($user->role) }}
            </span>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Modifier mes informations</h3>

        <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data" class="space-y-5">
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
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo de profil</label>
                <input type="file" name="photo" accept="image/*" id="photo-input"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-yellow-400 file:text-gray-900 file:font-semibold hover:file:bg-yellow-500">
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Changer le mot de passe (optionnel)</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Nouveau mot de passe</label>
                        <input type="password" name="password"
                               class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 rounded-lg transition">
                    Enregistrer les modifications
                </button>
                <a href="{{ route('dashboard') }}"
                   class="flex-1 text-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 py-2 rounded-lg transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('photo-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection