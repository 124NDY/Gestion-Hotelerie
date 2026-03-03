@extends('layouts.main')

@section('title', 'Modifier Chambre')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Modifier la Chambre N° {{ $chambre->numero }}</h3>
    </div>
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chambres.update', $chambre->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label><i class="fas fa-door-open mr-1"></i> Numéro de chambre</label>
                <input type="text" name="numero" class="form-control"
                       value="{{ old('numero', $chambre->numero) }}" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-bed mr-1"></i> Type de chambre</label>
                <select name="type" class="form-control" required>
                    <option value="simple" {{ old('type', $chambre->type) == 'simple' ? 'selected' : '' }}>🛏️ Simple</option>
                    <option value="double" {{ old('type', $chambre->type) == 'double' ? 'selected' : '' }}>🛏️🛏️ Double</option>
                    <option value="suite" {{ old('type', $chambre->type) == 'suite' ? 'selected' : '' }}>👑 Suite</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-money-bill mr-1"></i> Prix par nuit (Ar)</label>
                <input type="number" name="prix_nuit" class="form-control"
                       value="{{ old('prix_nuit', $chambre->prix_nuit) }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-info-circle mr-1"></i> Statut</label>
                <select name="statut" class="form-control" required>
                    <option value="disponible" {{ old('statut', $chambre->statut) == 'disponible' ? 'selected' : '' }}>✅ Disponible</option>
                    <option value="occupee" {{ old('statut', $chambre->statut) == 'occupee' ? 'selected' : '' }}>🔴 Occupée</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-align-left mr-1"></i> Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $chambre->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('chambres.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Modifier
                </button>
            </div>

        </form>
    </div>
</div>
@endsection