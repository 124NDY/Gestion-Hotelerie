@extends('layouts.app')

@section('title', 'Nouvelle reservation')
@section('page-title', 'Nouvelle Reservation')

@section('content')

<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow p-8">
    <form method="POST" action="{{ route('bookings.store') }}" class="space-y-5">
        @csrf

        @if($clients)
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Client</label>
            <select name="user_id" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="">-- Choisir un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('user_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->nom }} ({{ $client->email }})
                    </option>
                @endforeach
            </select>
        </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Chambre</label>
            <select name="room_id" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="">-- Choisir une chambre --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ old('room_id', request('room_id')) == $room->id ? 'selected' : '' }}>
                        Chambre {{ $room->numero }} - {{ $room->type }} - {{ number_format($room->prix_nuit, 2) }} $/nuit
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date d'arrivee</label>
                <input type="date" name="date_debut" value="{{ old('date_debut') }}"
                       min="{{ date('Y-m-d') }}"
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date de depart</label>
                <input type="date" name="date_fin" value="{{ old('date_fin') }}"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                       class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
        </div>

        <!-- Calcul automatique -->
        <div id="calcul" class="hidden bg-yellow-50 dark:bg-gray-700 border border-yellow-200 dark:border-gray-600 rounded-lg p-4">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Duree : <span id="nuits" class="font-bold">0</span> nuit(s)
                &mdash; Total estimé : <span id="total" class="font-bold text-yellow-600">0.00 $</span>
            </p>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 rounded-lg transition">
                Confirmer la reservation
            </button>
            <a href="{{ route('bookings.index') }}"
               class="flex-1 text-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 py-2 rounded-lg transition">
                Annuler
            </a>
        </div>
    </form>
</div>

<script>
    const prices = {
        @foreach($rooms as $room)
        {{ $room->id }}: {{ $room->prix_nuit }},
        @endforeach
    };

    function calculer() {
        const roomId  = document.querySelector('[name="room_id"]').value;
        const debut   = document.querySelector('[name="date_debut"]').value;
        const fin     = document.querySelector('[name="date_fin"]').value;

        if (roomId && debut && fin) {
            const d1    = new Date(debut);
            const d2    = new Date(fin);
            const nuits = Math.round((d2 - d1) / (1000 * 60 * 60 * 24));

            if (nuits > 0) {
                const total = nuits * prices[roomId];
                document.getElementById('nuits').textContent  = nuits;
                document.getElementById('total').textContent  = total.toFixed(2) + ' $';
                document.getElementById('calcul').classList.remove('hidden');
            }
        }
    }

    document.querySelector('[name="room_id"]').addEventListener('change', calculer);
    document.querySelector('[name="date_debut"]').addEventListener('change', calculer);
    document.querySelector('[name="date_fin"]').addEventListener('change', calculer);
</script>

@endsection