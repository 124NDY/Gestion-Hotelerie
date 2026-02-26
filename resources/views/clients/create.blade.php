@extends('layouts.app')

@section('title', 'Ajouter un Client')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">➕ Ajouter un Client</h4>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom</label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                        value="{{ old('nom') }}" placeholder="Ex: Rakoto">
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Prénom</label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                        value="{{ old('prenom') }}" placeholder="Ex: Jean">
                    @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Ex: jean@email.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Téléphone</label>
                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                        value="{{ old('telephone') }}" placeholder="Ex: 034 00 000 00">
                    @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">CIN</label>
                    <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror"
                        value="{{ old('cin') }}" placeholder="Ex: 123456789012">
                    @error('cin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Adresse</label>
                    <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                        value="{{ old('adresse') }}" placeholder="Ex: Antananarivo">
                    @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">💾 Enregistrer</button>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection