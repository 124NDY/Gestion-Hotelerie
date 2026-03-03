@extends('layouts.app')

@section('title', 'Historique des Réservations')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">📋 Historique des Réservations</h4>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
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
                    <td><strong>{{ $reservation->client->nom }} {{ $reservation->client->prenom }}</strong></td>
                    <td>Chambre {{ $reservation->chambre->numero }}</td>
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
                    <td colspan="6" class="text-center text-muted py-4">Aucune réservation trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection