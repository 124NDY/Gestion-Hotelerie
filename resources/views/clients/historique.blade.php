@extends('layouts.app')

@section('title', 'Historique du Client')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">📋 Historique de {{ $client->nom }} {{ $client->prenom }}</h4>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<!-- Infos Client -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header fw-bold bg-dark text-white">👤 Informations du Client</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <p><strong>Nom complet :</strong> {{ $client->nom }} {{ $client->prenom }}</p>
                <p><strong>Email :</strong> {{ $client->email }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Téléphone :</strong> {{ $client->telephone }}</p>
                <p><strong>CIN :</strong> {{ $client->cin }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Adresse :</strong> {{ $client->adresse ?? 'Non renseignée' }}</p>
                <p><strong>Total réservations :</strong> {{ $reservations->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Historique Réservations -->
<div class="card shadow-sm border-0">
    <div class="card-header fw-bold bg-dark text-white">📅 Réservations</div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>#</th>
                    <th>Chambre</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td><strong>{{ $reservation->chambre->numero }}</strong> - {{ ucfirst($reservation->chambre->type) }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}</td>
                    <td>
                        @if($reservation->statut == 'active')
                            <span class="badge bg-success">✅ Active</span>
                        @elseif($reservation->statut == 'annulee')
                            <span class="badge bg-danger">❌ Annulée</span>
                        @else
                            <span class="badge bg-secondary">🏁 Terminée</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Aucune réservation trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection