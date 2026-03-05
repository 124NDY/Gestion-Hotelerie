@extends('layouts.app')

@section('title', 'Chambre ' . $room->numero)
@section('page-title', 'Detail de la Chambre')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

        <div class="relative h-72">
            <img src="{{ asset('storage/' . $room->photo_url) }}"
                 class="w-full h-full object-cover" alt="Chambre {{ $room->numero }}">
            <div class="absolute top-4 right-4">
                @if($room->statut === 'disponible')
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Disponible</span>
                @elseif($room->statut === 'occupee')
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">Occupee</span>
                @else
                    <span class="bg-orange-400 text-white px-3 py-1 rounded-full text-sm font-medium">Menage</span>
                @endif
            </div>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Chambre {{ $room->numero }}</h2>
                    <p class="text-gray-500 dark:text-gray-400">{{ $room->type }}</p>
                </div>
                <p class="text-2xl font-bold text-yellow-500">{{ number_format($room->prix_nuit, 2) }} MGA/nuit</p>
            </div>

            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6">{{ $room->description }}</p>

            <div class="flex gap-3">
                @if($room->statut === 'disponible')
                <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-6 py-2 rounded-lg transition text-sm">
                    Reserver cette chambre
                </a>
                @endif
                <a href="{{ route('rooms.index') }}"
                   class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 px-6 py-2 rounded-lg transition text-sm">
                    Retour
                </a>
            </div>
        </div>
    </div>
</div>

@endsection