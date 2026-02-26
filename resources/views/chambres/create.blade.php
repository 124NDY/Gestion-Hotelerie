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

@endsection