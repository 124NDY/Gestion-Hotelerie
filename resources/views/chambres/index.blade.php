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

@endsection