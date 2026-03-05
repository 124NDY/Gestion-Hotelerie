@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

<!-- Cartes statistiques -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border-l-4 border-yellow-400">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Chambres</p>
        <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['total_chambres'] }}</p>
        <p class="text-xs text-green-500 mt-2">{{ $stats['chambres_dispo'] }} disponibles</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border-l-4 border-red-400">
        <p class="text-sm text-gray-500 dark:text-gray-400">Chambres Occupees</p>
        <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['chambres_occupees'] }}</p>
        <p class="text-xs text-gray-400 mt-2">En ce moment</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border-l-4 border-blue-400">
        <p class="text-sm text-gray-500 dark:text-gray-400">Reservations Actives</p>
        <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $stats['reservations_actives'] }}</p>
        <p class="text-xs text-gray-400 mt-2">{{ $stats['total_reservations'] }} au total</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border-l-4 border-green-400">
        <p class="text-sm text-gray-500 dark:text-gray-400">Recettes du Mois</p>
        <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($stats['recettes_mois'], 2) }} MGA</p>
        <p class="text-xs text-gray-400 mt-2">{{ number_format($stats['recettes_jour'], 2) }} MGA aujourd'hui</p>
    </div>

</div>

<!-- Reservations recentes -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Reservations Recentes</h3>

    @if($reservations_recentes->isEmpty())
        <p class="text-gray-400 text-sm">Aucune reservation pour le moment.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 dark:text-gray-400 border-b dark:border-gray-700">
                        <th class="pb-3 font-medium">Client</th>
                        <th class="pb-3 font-medium">Chambre</th>
                        <th class="pb-3 font-medium">Dates</th>
                        <th class="pb-3 font-medium">Total</th>
                        <th class="pb-3 font-medium">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($reservations_recentes as $booking)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="py-3">
                            <div class="flex items-center gap-2">
                                <img src="{{ $booking->user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $booking->user->photo_url) }}"
                                     class="w-8 h-8 rounded-full object-cover" alt="">
                                <span class="font-medium text-gray-800 dark:text-white">{{ $booking->user->nom }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-gray-600 dark:text-gray-300">
                            Chambre {{ $booking->room->numero }}
                        </td>
                        <td class="py-3 text-gray-600 dark:text-gray-300">
                            {{ $booking->date_debut->format('d/m/Y') }} - {{ $booking->date_fin->format('d/m/Y') }}
                        </td>
                        <td class="py-3 font-semibold text-gray-800 dark:text-white">
                            {{ number_format($booking->total_prix, 2) }} MGA
                        </td>
                        <td class="py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $booking->statut_booking === 'confirme' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($booking->statut_booking) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection