@extends('layouts.app')

@section('title', 'Detail reservation')
@section('page-title', 'Detail de la Reservation')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
        <div class="grid grid-cols-2">

            <div class="p-8 border-r border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4">Client</h3>
                <div class="flex items-center gap-4">
                    <img src="{{ $booking->user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $booking->user->photo_url) }}"
                         class="w-16 h-16 rounded-full object-cover border-2 border-yellow-400" alt="">
                    <div>
                        <p class="font-semibold text-gray-800 dark:text-white">{{ $booking->user->nom }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4">Chambre</h3>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $booking->room->photo_url) }}"
                         class="w-16 h-16 rounded-lg object-cover" alt="">
                    <div>
                        <p class="font-semibold text-gray-800 dark:text-white">Chambre {{ $booking->room->numero }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->room->type }}</p>
                        <p class="text-sm text-yellow-500 font-semibold">{{ number_format($booking->room->prix_nuit, 2) }} MGA/nuit</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-8 py-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600">
            <div class="grid grid-cols-4 gap-6 text-center">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Arrivee</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $booking->date_debut->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Depart</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $booking->date_fin->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nuits</p>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $booking->nuits }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total</p>
                    <p class="font-bold text-yellow-500 text-lg">{{ number_format($booking->total_prix, 2) }} MGA</p>
                </div>
            </div>
        </div>

        <div class="px-8 py-4 flex items-center justify-between">
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $booking->statut_booking === 'confirme' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ ucfirst($booking->statut_booking) }}
            </span>

            <div class="flex gap-3">
                @if($booking->statut_booking === 'confirme')
                    <form method="POST" action="{{ route('bookings.annuler', $booking) }}"
                          onsubmit="return confirm('Annuler cette reservation ?')">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="text-sm bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-lg transition">
                            Annuler la reservation
                        </button>
                    </form>
                    @if((auth()->user()->isAdmin() || auth()->user()->isReceptionniste()) && !$booking->payment)
                    <a href="{{ route('payments.create', $booking) }}"
                       class="text-sm bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-4 py-2 rounded-lg transition">
                        Enregistrer le paiement
                    </a>
                    @endif
                @endif
                @if($booking->payment)
                <a href="{{ route('payments.facture', $booking->payment) }}"
                   class="text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-lg transition">
                    Voir la facture
                </a>
                @endif
            </div>
        </div>
    </div>
    
    @if(auth()->user()->isClient() && $booking->statut_booking === 'confirme' && !$booking->review)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mt-6">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Laisser un avis</h3>
        <form method="POST" action="{{ route('reviews.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Note</label>
                <div class="flex gap-2">
                    @for($i = 1; $i <= 5; $i++)
                    <label class="cursor-pointer">
                        <input type="radio" name="note" value="{{ $i }}" class="hidden peer">
                        <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 transition"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </label>
                    @endfor
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Commentaire (optionnel)</label>
                <textarea name="commentaire" rows="3"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
            </div>

            <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-2 rounded-lg transition text-sm">
                Envoyer mon avis
            </button>
        </form>
    </div>
    @endif

    <a href="{{ route('bookings.index') }}"
       class="inline-block text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition">
        Retour aux reservations
    </a>
</div>

@endsection