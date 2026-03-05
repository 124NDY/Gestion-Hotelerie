@extends('layouts.app')

@section('title', 'Avis Clients')
@section('page-title', 'Avis Clients')

@section('content')

<div class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex items-center gap-6">
    <div class="text-center">
        <p class="text-5xl font-bold text-yellow-400">{{ number_format($moyenne, 1) }}</p>
        <div class="flex gap-1 justify-center mt-2">
            @for($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= round($moyenne) ? 'text-yellow-400' : 'text-gray-300' }}"
                     fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
        </div>
        <p class="text-sm text-gray-400 mt-1">{{ $reviews->total() }} avis</p>
    </div>
</div>

<div class="space-y-4">
    @forelse($reviews as $review)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ $review->user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $review->user->photo_url) }}"
                     class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400" alt="">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $review->user->nom }}</p>
                    <p class="text-xs text-gray-400">
                        Chambre {{ $review->booking->room->numero }} -
                        {{ $review->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
            <div class="flex gap-1">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $review->note ? 'text-yellow-400' : 'text-gray-300' }}"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endfor
            </div>
        </div>
        @if($review->commentaire)
        <p class="mt-3 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
            {{ $review->commentaire }}
        </p>
        @endif
    </div>
    @empty
    <div class="text-center text-gray-400 py-16">
        Aucun avis pour le moment.
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $reviews->links() }}
</div>

@endsection