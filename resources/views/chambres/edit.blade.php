@extends('layouts.app')

@section('title', 'Modifier une Chambre')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">✏️ Modifier la Chambre {{ $chambre->numero }}</h4>
    <a href="{{ route('chambres.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('chambres.update', $chambre) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Numéro de Chambre</label>
                    <input type="text" name="numero" class="form-control @error('numero') is-invalid @enderror"
                        value="{{ old('numero', $chambre->numero) }}">
                    @error('numero') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select">
                        <option value="simple" {{ old('type', $chambre->type) == 'simple' ? 'selected' : '' }}>Simple</option>
                        <option value="double" {{ old('type', $chambre->type) == 'double' ? 'selected' : '' }}>Double</option>
                        <option value="suite" {{ old('type', $chambre->type) == 'suite' ? 'selected' : '' }}>Suite</option>
                        <option value="vip" {{ old('type', $chambre->type) == 'vip' ? 'selected' : '' }}>VIP</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Prix par Nuit (Ar)</label>
                    <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror"
                        value="{{ old('prix', $chambre->prix) }}">
                    @error('prix') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="disponible" {{ old('statut', $chambre->statut) == 'disponible' ? 'selected' : '' }}>✅ Disponible</option>
                        <option value="occupee" {{ old('statut', $chambre->statut) == 'occupee' ? 'selected' : '' }}>🔴 Occupée</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($chambre->image)
                        <small class="text-muted">Image actuelle : {{ $chambre->image }}</small>
                    @endif
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $chambre->description) }}</textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-warning">💾 Mettre à jour</button>
                    <a href="{{ route('chambres.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection