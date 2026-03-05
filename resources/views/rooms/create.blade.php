@extends('layouts.app')

@section('title', 'Ajouter une chambre')
@section('page-title', 'Ajouter une Chambre')

@section('content')

<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow p-8">
    <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Numero de chambre</label>
            <input type="text" name="numero" value="{{ old('numero') }}"
                   class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
            <select name="type" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="">-- Choisir --</option>
                <option value="Simple" {{ old('type') === 'Simple' ? 'selected' : '' }}>Simple</option>
                <option value="Double" {{ old('type') === 'Double' ? 'selected' : '' }}>Double</option>
                <option value="Suite" {{ old('type') === 'Suite' ? 'selected' : '' }}>Suite</option>
                <option value="Suite Presidentielle" {{ old('type') === 'Suite Presidentielle' ? 'selected' : '' }}>Suite Presidentielle</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prix par nuit ($)</label>
            <input type="number" name="prix_nuit" value="{{ old('prix_nuit') }}" step="0.01" min="0"
                   class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo (obligatoire)</label>
            <input type="file" name="photo" accept="image/*"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-yellow-400 file:text-gray-900 file:font-semibold hover:file:bg-yellow-500">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 rounded-lg transition">
                Enregistrer
            </button>
            <a href="{{ route('rooms.index') }}"
               class="flex-1 text-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 py-2 rounded-lg transition">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection