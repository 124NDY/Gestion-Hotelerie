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
            <thead class="thead-dark">                <tr>
                    <th>#</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>CIN</th>
                    <th>Nationalité</th>                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
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
                            </button>                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Aucun client trouvé</td>                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $clients->links() }}
    </div>
</div>@endsection
