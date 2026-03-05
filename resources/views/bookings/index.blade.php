@extends('layouts.app')

@section('title', 'Reservations')
@section('page-title', 'Gestion des Reservations')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $bookings->total() }} reservation(s)</p>
    <a href="{{ route('bookings.create') }}"
       class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-4 py-2 rounded-lg transition text-sm">
        Nouvelle reservation
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr class="text-left text-gray-500 dark:text-gray-400">
                    <th class="px-6 py-4 font-medium">Client</th>
                    <th class="px-6 py-4 font-medium">Chambre</th>
                    <th class="px-6 py-4 font-medium">Dates</th>
                    <th class="px-6 py-4 font-medium">Nuits</th>
                    <th class="px-6 py-4 font-medium">Total</th>
                    <th class="px-6 py-4 font-medium">Statut</th>
                    <th class="px-6 py-4 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ $booking->user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $booking->user->photo_url) }}"
                                 class="w-8 h-8 rounded-full object-cover" alt="">
                            <span class="font-medium text-gray-800 dark:text-white">{{ $booking->user->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('storage/' . $booking->room->photo_url) }}"
                                 class="w-8 h-8 rounded object-cover" alt="">
                            Chambre {{ $booking->room->numero }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        {{ $booking->date_debut->format('d/m/Y') }}<br>
                        <span class="text-xs text-gray-400">au {{ $booking->date_fin->format('d/m/Y') }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        {{ $booking->nuits }}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800 dark:text-white">
                        {{ number_format($booking->total_prix, 2) }} MGA
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $booking->statut_booking === 'confirme' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($booking->statut_booking) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('bookings.show', $booking) }}"
                               class="text-xs bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-lg transition">
                                Voir
                            </a>
                            @if($booking->statut_booking === 'confirme')
                            <form method="POST" action="{{ route('bookings.annuler', $booking) }}"
                                  onsubmit="return confirm('Annuler cette reservation ?')">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="text-xs bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1 rounded-lg transition">
                                    Annuler
                                </button>
                            </form>
                            @endif
                            @if(auth()->user()->isAdmin() || auth()->user()->isReceptionniste())
                                @if($booking->statut_booking === 'confirme' && !$booking->payment)
                                <a href="{{ route('payments.create', $booking) }}"
                                   class="text-xs bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-3 py-1 rounded-lg transition">
                                    Payer
                                </a>
                                @elseif($booking->payment)
                                <a href="{{ route('payments.facture', $booking->payment) }}"
                                   class="text-xs bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-lg transition">
                                    Facture
                                </a>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center text-gray-400">
                        Aucune reservation trouvee.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $bookings->links() }}
</div>

@endsection