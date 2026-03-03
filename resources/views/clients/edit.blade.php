<<<<<<< HEAD
@extends('layouts.main')

@section('title', 'Modifier Client')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-edit mr-2"></i>Modifier le Client</h3>
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

        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-user mr-1"></i> Nom</label>
                        <input type="text" name="nom" class="form-control"
                               value="{{ old('nom', $client->nom) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-user mr-1"></i> Prénom</label>
                        <input type="text" name="prenom" class="form-control"
                               value="{{ old('prenom', $client->prenom) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-envelope mr-1"></i> Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $client->email) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-phone mr-1"></i> Téléphone</label>
                        <input type="text" name="telephone" class="form-control"
                               value="{{ old('telephone', $client->telephone) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-id-card mr-1"></i> CIN</label>
                        <input type="text" name="cin" class="form-control"
                               value="{{ old('cin', $client->cin) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-flag mr-1"></i> Nationalité</label>
                        <input type="text" name="nationalite" class="form-control"
                               value="{{ old('nationalite', $client->nationalite) }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-map-marker-alt mr-1"></i> Adresse</label>
                <textarea name="adresse" class="form-control" rows="2">{{ old('adresse', $client->adresse) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Modifier
                </button>
            </div>

        </form>
    </div>
</div>
=======
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

>>>>>>> b336feec924672af61f2f862ed61714546fd3112
@endsection