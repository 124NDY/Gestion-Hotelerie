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
</div>@endsection
