@extends('layouts.app')

@section('title', 'Modifier un Client')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">✏️ Modifier {{ $client->nom }} {{ $client->prenom }}</h4>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('clients.update', $client) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom</label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                        value="{{ old('nom', $client->nom) }}">
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Prénom</label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                        value="{{ old('prenom', $client->prenom) }}">
                    @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $client->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Téléphone</label>
                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                        value="{{ old('telephone', $client->telephone) }}">
                    @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">CIN</label>
                    <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror"
                        value="{{ old('cin', $client->cin) }}">
                    @error('cin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Adresse</label>
                    <input type="text" name="adresse" class="form-control"
                        value="{{ old('adresse', $client->adresse) }}">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-warning">💾 Mettre à jour</button>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection