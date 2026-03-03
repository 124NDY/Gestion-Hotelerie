@extends('layouts.main')

@section('title', 'Liste des Chambres')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-bed mr-2"></i>Liste des Chambres</h3>
        <a href="{{ route('chambres.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nouvelle Chambre
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Numéro</th>
                    <th>Type</th>
                    <th>Prix/Nuit</th>
                    <th>Statut</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($chambres as $chambre)
                <tr>
                    <td>{{ $chambre->id }}</td>
                    <td><strong>{{ $chambre->numero }}</strong></td>
                    <td>{{ ucfirst($chambre->type) }}</td>
                    <td>{{ number_format($chambre->prix_nuit, 2) }} Ar</td>
                    <td>
                        @if($chambre->statut == 'disponible')
                            <span class="badge badge-success">✅ Disponible</span>
                        @else
                            <span class="badge badge-danger">🔴 Occupée</span>
                        @endif
                    </td>
                    <td>{{ $chambre->description ?? '—' }}</td>
                    <td>
                        <a href="{{ route('chambres.show', $chambre->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('chambres.edit', $chambre->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('chambres.destroy', $chambre->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer cette chambre ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Aucune chambre trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $chambres->links() }}
    </div>
</div>@endsection
