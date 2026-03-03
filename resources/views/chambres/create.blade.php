<<<<<<< HEAD
@extends('layouts.main')

@section('title', 'Nouvelle Chambre')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Ajouter une Chambre</h3>
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

        <form action="{{ route('chambres.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label><i class="fas fa-door-open mr-1"></i> Numéro de chambre</label>
                <input type="text" name="numero" class="form-control"
                       value="{{ old('numero') }}" placeholder="Ex: 101" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-bed mr-1"></i> Type de chambre</label>
                <select name="type" class="form-control" required>
                    <option value="">-- Choisir un type --</option>
                    <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>🛏️ Simple</option>
                    <option value="double" {{ old('type') == 'double' ? 'selected' : '' }}>🛏️🛏️ Double</option>
                    <option value="suite" {{ old('type') == 'suite' ? 'selected' : '' }}>👑 Suite</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-money-bill mr-1"></i> Prix par nuit (Ar)</label>
                <input type="number" name="prix_nuit" class="form-control"
                       value="{{ old('prix_nuit') }}" step="0.01" placeholder="Ex: 50000" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-info-circle mr-1"></i> Statut</label>
                <select name="statut" class="form-control" required>
                    <option value="disponible" {{ old('statut') == 'disponible' ? 'selected' : '' }}>✅ Disponible</option>
                    <option value="occupee" {{ old('statut') == 'occupee' ? 'selected' : '' }}>🔴 Occupée</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-align-left mr-1"></i> Description</label>
                <textarea name="description" class="form-control" rows="3"
                          placeholder="Description de la chambre...">{{ old('description') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('chambres.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>

        </form>
    </div>
</div>
=======
@extends('layouts.app')

@section('title', 'Ajouter une Chambre')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">➕ Ajouter une Chambre</h4>
    <a href="{{ route('chambres.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('chambres.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Numéro de Chambre</label>
                    <input type="text" name="numero" class="form-control @error('numero') is-invalid @enderror"
                        value="{{ old('numero') }}" placeholder="Ex: 101">
                    @error('numero') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="">-- Choisir --</option>
                        <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>Simple</option>
                        <option value="double" {{ old('type') == 'double' ? 'selected' : '' }}>Double</option>
                        <option value="suite" {{ old('type') == 'suite' ? 'selected' : '' }}>Suite</option>
                        <option value="vip" {{ old('type') == 'vip' ? 'selected' : '' }}>VIP</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Prix par Nuit (Ar)</label>
                    <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror"
                        value="{{ old('prix') }}" placeholder="Ex: 50000">
                    @error('prix') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                        placeholder="Description de la chambre...">{{ old('description') }}</textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                    <a href="{{ route('chambres.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

>>>>>>> b336feec924672af61f2f862ed61714546fd3112
@endsection