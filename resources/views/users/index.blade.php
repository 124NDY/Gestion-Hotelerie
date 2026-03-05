@extends('layouts.app')

@section('title', 'Utilisateurs')
@section('page-title', 'Gestion des Utilisateurs')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $users->total() }} utilisateur(s)</p>
    <a href="{{ route('users.create') }}"
       class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold px-4 py-2 rounded-lg transition text-sm">
        Ajouter un utilisateur
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr class="text-left text-gray-500 dark:text-gray-400">
                    <th class="px-6 py-4 font-medium">Utilisateur</th>
                    <th class="px-6 py-4 font-medium">Email</th>
                    <th class="px-6 py-4 font-medium">Role</th>
                    <th class="px-6 py-4 font-medium">Inscrit le</th>
                    <th class="px-6 py-4 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $user->photo_url === 'default_user.jpg' ? asset('images/default_user.jpg') : asset('storage/' . $user->photo_url) }}"
                                 class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600" alt="">
                            <span class="font-medium text-gray-800 dark:text-white">{{ $user->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($user->role === 'admin') bg-purple-100 text-purple-700
                            @elseif($user->role === 'receptionniste') bg-blue-100 text-blue-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                        {{ $user->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('users.show', $user) }}"
                               class="text-xs bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-lg transition">
                                Voir
                            </a>
                            <a href="{{ route('users.edit', $user) }}"
                               class="text-xs bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-3 py-1 rounded-lg transition">
                                Modifier
                            </a>
                            @if(auth()->id() !== $user->id)
                            <form method="POST" action="{{ route('users.destroy', $user) }}"
                                  onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="text-xs bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1 rounded-lg transition">
                                    Supprimer
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                        Aucun utilisateur trouve.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>

@endsection