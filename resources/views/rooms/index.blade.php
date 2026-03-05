@extends('layouts.app')

@section('title', 'Chambres')
@section('page-title', 'Gestion des Chambres')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $rooms->total() }} chambre(s) au total</p>
    @if(auth()->user()->isAdmin() || auth()->user()->isReceptionniste())
        <a href="{{ route('rooms.create') }}"
           class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-4 py-2 rounded-lg transition text-sm">
            Ajouter une chambre
        </a>
    @endif
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($rooms as $room)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden group">

        <!-- Photo avec bandeau statut -->
        <div class="relative h-48 overflow-hidden">
            <img src="{{ asset('storage/' . $room->photo_url) }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                 alt="Chambre {{ $room->numero }}">
            <div class="absolute top-3 right-3">
                @if($room->statut === 'disponible')
                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">Disponible</span>
                @elseif($room->statut === 'occupee')
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-medium">Occupee</span>
                @else
                    <span class="bg-orange-400 text-white text-xs px-2 py-1 rounded-full font-medium">Menage</span>
                @endif
            </div>
        </div>

        <!-- Infos -->
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <h3 class="font-semibold text-gray-800 dark:text-white">Chambre {{ $room->numero }}</h3>
                <span class="text-yellow-500 font-bold text-sm">{{ number_format($room->prix_nuit, 2) }} MGA/nuit</span>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">{{ $room->type }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 line-clamp-2">{{ $room->description }}</p>

            <!-- Actions -->
            <div class="flex gap-2 mt-4 flex-wrap">
                <a href="{{ route('rooms.show', $room) }}"
                   class="flex-1 text-center text-xs bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 py-2 rounded-lg transition">
                    Voir
                </a>
                @if(auth()->user()->isAdmin() || auth()->user()->isReceptionniste())
                <a href="{{ route('rooms.edit', $room) }}"
                   class="flex-1 text-center text-xs bg-yellow-400 hover:bg-yellow-500 text-gray-900 py-2 rounded-lg transition">
                    Modifier
                </a>
                <!-- Statut rapide -->
                <div class="w-full mt-1">
                    <select onchange="window.location='/rooms/{{ $room->id }}/statut?statut='+this.value"
                            class="w-full text-xs border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg px-2 py-1 focus:outline-none">
                        <option value="disponible" {{ $room->statut === 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="occupee" {{ $room->statut === 'occupee' ? 'selected' : '' }}>Occupee</option>
                        <option value="menage" {{ $room->statut === 'menage' ? 'selected' : '' }}>Menage</option>
                    </select>
                </div>
                @endif
                @if(auth()->user()->isAdmin())
                <form method="POST" action="{{ route('rooms.destroy', $room) }}"
                      onsubmit="return confirm('Supprimer cette chambre ?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="text-xs bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded-lg transition">
                        X
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @empty
        <div class="col-span-4 text-center text-gray-400 py-16">
            <p class="text-lg">Aucune chambre enregistree.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $rooms->links() }}
</div>

@endsection