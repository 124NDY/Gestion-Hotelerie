@extends('layouts.app')

@section('title', 'Paiements')
@section('page-title', 'Historique des Paiements')

@section('content')

<div class="grid grid-cols-2 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border-l-4 border-yellow-400">
        <p class="text-sm text-gray-500 dark:text-gray-400">Recettes du jour</p>
        <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($total_jour, 2) }} MGA</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border-l-4 border-green-400">
        <p class="text-sm text-gray-500 dark:text-gray-400">Recettes du mois</p>
        <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($total_mois, 2) }} MGA</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr class="text-left text-gray-500 dark:text-gray-400">
                    <th class="px-6 py-4 font-medium">Client</th>
                    <th class="px-6 py-4 font-medium">Chambre</th>
                    <th class="px-6 py-4 font-medium">Sejour</th>
                    <th class="px-6 py-4 font-medium">Methode</th>
                    <th class="px-6 py-4 font-medium">Montant</th>
                    <th class="px-6 py-4 font-medium">Date</th>
                    <th class="px-6 py-4 font-medium">Facture</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($payments as $payment)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ $payment->booking->user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $payment->booking->user->photo_url) }}"
                                 class="w-8 h-8 rounded-full object-cover" alt="">
                            <span class="font-medium text-gray-800 dark:text-white">{{ $payment->booking->user->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        Chambre {{ $payment->booking->room->numero }}
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        {{ $payment->booking->date_debut->format('d/m/Y') }} -
                        {{ $payment->booking->date_fin->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded text-xs capitalize">
                            {{ $payment->methode }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-bold text-green-600">
                        {{ number_format($payment->montant, 2) }} MGA
                    </td>
                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                        {{ $payment->date_paiement->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('payments.facture', $payment) }}"
                           class="text-xs bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-lg transition">
                            Voir
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center text-gray-400">
                        Aucun paiement enregistre.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $payments->links() }}
</div>

@endsection