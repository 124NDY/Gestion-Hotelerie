<<<<<<< HEAD
@extends('layouts.main')

@section('title', 'Nouveau Paiement')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Enregistrer un Paiement</h3>
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

        <form action="{{ route('paiements.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label><i class="fas fa-calendar-alt mr-1"></i> Réservation</label>
                <select name="reservation_id" class="form-control" required>
                    <option value="">-- Sélectionner une réservation --</option>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}" {{ old('reservation_id') == $reservation->id ? 'selected' : '' }}>
                            #{{ $reservation->id }} — {{ $reservation->client->prenom }} {{ $reservation->client->nom }}
                            ({{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}
                            → {{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }})
                            — {{ number_format($reservation->montant_total, 2) }} Ar
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-money-bill mr-1"></i> Montant (Ar)</label>
                <input type="number" name="montant" class="form-control" 
                       value="{{ old('montant') }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-credit-card mr-1"></i> Méthode de paiement</label>
                <select name="methode" class="form-control" required>
                    <option value="">-- Choisir --</option>
                    <option value="espece" {{ old('methode') == 'espece' ? 'selected' : '' }}>💵 Espèce</option>
                    <option value="carte" {{ old('methode') == 'carte' ? 'selected' : '' }}>💳 Carte bancaire</option>
                    <option value="virement" {{ old('methode') == 'virement' ? 'selected' : '' }}>🏦 Virement</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-check-circle mr-1"></i> Statut</label>
                <select name="statut" class="form-control" required>
                    <option value="paye" {{ old('statut') == 'paye' ? 'selected' : '' }}>✅ Payé</option>
                    <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
                    <option value="rembourse" {{ old('statut') == 'rembourse' ? 'selected' : '' }}>🔄 Remboursé</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-calendar mr-1"></i> Date de paiement</label>
                <input type="date" name="date_paiement" class="form-control" 
                       value="{{ old('date_paiement', date('Y-m-d')) }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
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

@section('title', 'Enregistrer un Paiement')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">💰 Enregistrer un Paiement</h4>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<!-- Résumé Réservation -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header fw-bold bg-dark text-white">📋 Résumé de la Réservation</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <p><strong>Client :</strong> {{ $reservation->client->nom }} {{ $reservation->client->prenom }}</p>
                <p><strong>Email :</strong> {{ $reservation->client->email }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Chambre :</strong> {{ $reservation->chambre->numero }} - {{ ucfirst($reservation->chambre->type) }}</p>
                <p><strong>Prix/nuit :</strong> {{ number_format($reservation->chambre->prix, 0, ',', ' ') }} Ar</p>
            </div>
            <div class="col-md-4">
                <p><strong>Arrivée :</strong> {{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}</p>
                <p><strong>Départ :</strong> {{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}</p>
                <p><strong>Nuits :</strong> {{ $nuits }}</p>
            </div>
        </div>
        <div class="alert alert-success mb-0">
            💰 <strong>Montant Total : {{ number_format($montant, 0, ',', ' ') }} Ar</strong>
        </div>
    </div>
</div>

<!-- Formulaire Paiement -->
<div class="card shadow-sm border-0">
    <div class="card-header fw-bold bg-dark text-white">💳 Détails du Paiement</div>
    <div class="card-body">
        <form action="{{ route('paiements.store') }}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Montant (Ar)</label>
                    <input type="number" name="montant" class="form-control @error('montant') is-invalid @enderror"
                        value="{{ old('montant', $montant) }}">
                    @error('montant') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de Paiement</label>
                    <input type="date" name="date_paiement" class="form-control @error('date_paiement') is-invalid @enderror"
                        value="{{ old('date_paiement', date('Y-m-d')) }}">
                    @error('date_paiement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Mode de Paiement</label>
                    <select name="mode_paiement" class="form-select @error('mode_paiement') is-invalid @enderror">
                        <option value="especes" {{ old('mode_paiement') == 'especes' ? 'selected' : '' }}>💵 Espèces</option>
                        <option value="carte" {{ old('mode_paiement') == 'carte' ? 'selected' : '' }}>💳 Carte</option>
                        <option value="virement" {{ old('mode_paiement') == 'virement' ? 'selected' : '' }}>🏦 Virement</option>
                    </select>
                    @error('mode_paiement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Statut</label>
                    <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                        <option value="paye" {{ old('statut') == 'paye' ? 'selected' : '' }}>✅ Payé</option>
                        <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
                    </select>
                    @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">💾 Enregistrer le Paiement</button>
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>

>>>>>>> b336feec924672af61f2f862ed61714546fd3112
@endsection