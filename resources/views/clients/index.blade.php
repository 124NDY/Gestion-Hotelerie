<<<<<<< HEAD
@extends('layouts.main')

@section('title', 'Liste des Clients')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-users mr-2"></i>Liste des Clients</h3>
        <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nouveau Client
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
=======
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
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                <tr>
                    <th>#</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>CIN</th>
<<<<<<< HEAD
                    <th>Nationalité</th>
=======
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
<<<<<<< HEAD
                    <td><strong>{{ $client->prenom }} {{ $client->nom }}</strong></td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->cin }}</td>
                    <td>{{ $client->nationalite ?? '—' }}</td>
                    <td>
                        <a href="{{ route('clients.historique', $client->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-history"></i>
                        </a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer ce client ?')">
                                <i class="fas fa-trash"></i>
                            </button>
=======
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
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
<<<<<<< HEAD
                    <td colspan="7" class="text-center text-muted">Aucun client trouvé</td>
=======
                    <td colspan="6" class="text-center text-muted py-4">Aucun client trouvé</td>
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                </tr>
                @endforelse
            </tbody>
        </table>
<<<<<<< HEAD
        {{ $clients->links() }}
    </div>
</div>
=======
    </div>
</div>

>>>>>>> b336feec924672af61f2f862ed61714546fd3112
@endsection