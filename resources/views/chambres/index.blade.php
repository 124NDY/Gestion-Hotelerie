<<<<<<< HEAD
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
</div>
=======
@extends('layouts.app')

@section('title', 'Gestion des Chambres')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">🛏️ Liste des Chambres</h4>
    <a href="{{ route('chambres.create') }}" class="btn btn-primary">➕ Ajouter une Chambre</a>
</div>

@if($chambres->isEmpty())
    <div class="alert alert-info">Aucune chambre trouvée.</div>
@else
<div class="row g-4">
    @foreach($chambres as $chambre)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
            <!-- Image -->
            @if($chambre->image)
                <img src="{{ asset('storage/'.$chambre->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
            @else
                <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 200px; font-size: 4rem;">
                    🛏️
                </div>
            @endif

            <!-- Badge statut -->
            <div class="position-relative">
                <span class="position-absolute top-0 end-0 m-2">
                    @if($chambre->statut == 'disponible')
                        <span class="badge bg-success">✅ Disponible</span>
                    @else
                        <span class="badge bg-danger">🔴 Occupée</span>
                    @endif
                </span>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold mb-0">Chambre {{ $chambre->numero }}</h5>
                    <span class="badge bg-primary">{{ ucfirst($chambre->type) }}</span>
                </div>
                <p class="text-muted small mb-2">{{ $chambre->description ?? 'Aucune description' }}</p>
                <h6 class="text-success fw-bold">{{ number_format($chambre->prix, 0, ',', ' ') }} Ar / nuit</h6>
            </div>

            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3">
                <a href="{{ route('chambres.edit', $chambre) }}" class="btn btn-warning btn-sm flex-grow-1">✏️ Modifier</a>
                <form action="{{ route('chambres.destroy', $chambre) }}" method="POST" class="flex-grow-1"
                    onsubmit="return confirm('Voulez-vous vraiment supprimer cette chambre ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm w-100">🗑️ Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

>>>>>>> b336feec924672af61f2f862ed61714546fd3112
@endsection