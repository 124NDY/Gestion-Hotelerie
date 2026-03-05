@extends('layouts.app')

@section('title', 'Enregistrer un paiement')
@section('page-title', 'Enregistrer un Paiement')

@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    <!-- Recap reservation -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Recap de la reservation</h3>
        <div class="flex gap-4 items-center">
            <img src="{{ asset('storage/' . $booking->room->photo_url) }}"
                 class="w-20 h-20 rounded-lg object-cover" alt="">
            <div class="flex-1">
                <p class="font-semibold text-gray-800 dark:text-white">{{ $booking->user->nom }}</p>
                <p class="text-sm text-gray-500">Chambre {{ $booking->room->numero }} - {{ $booking->room->type }}</p>
                <p class="text-sm text-gray-500">
                    {{ $booking->date_debut->format('d/m/Y') }} au {{ $booking->date_fin->format('d/m/Y') }}
                    ({{ $booking->nuits }} nuits)
                </p>
            </div>
            <p class="text-2xl font-bold text-yellow-500">{{ number_format($booking->total_prix, 2) }} MGA</p>
        </div>
    </div>

    <!-- Formulaire paiement -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <form method="POST" action="{{ route('payments.store') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Methode de paiement</label>
                <select name="methode" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option value="especes">Especes</option>
                    <option value="carte">Carte bancaire</option>
                    <option value="virement">Virement</option>
                </select>
            </div>

            <div class="bg-yellow-50 dark:bg-gray-700 rounded-lg p-4">
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Montant a encaisser :
                    <span class="text-xl font-bold text-yellow-600 ml-2">{{ number_format($booking->total_prix, 2) }} MGA</span>
                </p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 rounded-lg transition">
                    Valider le paiement
                </button>
                <a href="{{ route('bookings.index') }}"
                   class="flex-1 text-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 py-2 rounded-lg transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@endsection