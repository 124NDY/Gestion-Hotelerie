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
</div>@endsection
