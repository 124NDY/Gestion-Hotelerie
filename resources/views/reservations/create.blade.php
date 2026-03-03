@extends('layouts.main')

@section('title', 'Nouvelle Réservation')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Créer une Réservation</h3>
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

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-user mr-1"></i> Client</label>
                        <select name="client_id" class="form-control" required>
                            <option value="">-- Sélectionner un client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->prenom }} {{ $client->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-bed mr-1"></i> Chambre</label>
                        <select name="chambre_id" class="form-control" required>
                            <option value="">-- Sélectionner une chambre --</option>
                            @foreach($chambres as $chambre)
                                <option value="{{ $chambre->id }}" {{ old('chambre_id') == $chambre->id ? 'selected' : '' }}>
                                    N° {{ $chambre->numero }} — {{ ucfirst($chambre->type) }} — {{ number_format($chambre->prix_nuit, 2) }} Ar/nuit
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-calendar mr-1"></i> Date d'arrivée</label>
                        <input type="date" name="date_arrivee" class="form-control"
                               value="{{ old('date_arrivee') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-calendar-check mr-1"></i> Date de départ</label>
                        <input type="date" name="date_depart" class="form-control"
                               value="{{ old('date_depart') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-sticky-note mr-1"></i> Notes</label>
                <textarea name="notes" class="form-control" rows="3"
                          placeholder="Notes supplémentaires...">{{ old('notes') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>

        </form>
    </div>
</div>
@endsection