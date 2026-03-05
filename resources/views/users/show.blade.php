@extends('layouts.app')

@section('title', 'Profil utilisateur')
@section('page-title', 'Profil Utilisateur')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 flex items-center gap-6">
        <img src="{{ $user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $user->photo_url) }}"
             class="w-24 h-24 rounded-full object-cover border-4 border-yellow-400" alt="">
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

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Historique des sejours</h3>

        @if($user->bookings->isEmpty())
            <p class="text-gray-400 text-sm">Aucun sejour enregistre.</p>
        @else
            <div class="space-y-3">
                @foreach($user->bookings as $booking)
                <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <img src="{{ asset('storage/' . $booking->room->photo_url) }}"
                         class="w-14 h-14 rounded-lg object-cover" alt="">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 dark:text-white">Chambre {{ $booking->room->numero }} - {{ $booking->room->type }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $booking->date_debut->format('d/m/Y') }} au {{ $booking->date_fin->format('d/m/Y') }}
                            ({{ $booking->nuits }} nuits)
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-yellow-500">{{ number_format($booking->total_prix, 2) }} $</p>
                        <span class="text-xs {{ $booking->statut_booking === 'confirme' ? 'text-green-600' : 'text-red-500' }}">
                            {{ ucfirst($booking->statut_booking) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <a href="{{ route('users.index') }}"
       class="inline-block text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition">
        Retour aux utilisateurs
    </a>
</div>

@endsection