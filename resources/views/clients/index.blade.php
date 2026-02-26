@extends('layouts.app')

@section('title', 'Gestion des Clients')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">👥 Liste des Clients</h4>
    <a href="{{ route('clients.create') }}" class="btn btn-success">➕ Ajouter un Client</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>CIN</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td><strong>{{ $client->nom }} {{ $client->prenom }}</strong></td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->cin }}</td>
                    <td>
                        <a href="{{ route('clients.historique', $client) }}" class="btn btn-sm btn-info text-white">📋 Historique</a>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Aucun client trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection