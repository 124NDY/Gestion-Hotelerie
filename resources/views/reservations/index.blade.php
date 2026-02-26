@extends('layouts.app')

@section('title', 'Gestion des Réservations')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">📅 Liste des Réservations</h4>
    <a href="{{ route('reservations.create') }}" class="btn btn-warning">➕ Nouvelle Réservation</a>
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
                    <th>Actions</th>
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
                    <td>
                        @if($reservation->statut == 'active')
                            <a href="{{ route('reservations.annuler', $reservation) }}"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Annuler cette réservation ?')">❌ Annuler</a>
                            @if(!$reservation->paiement)
                                <a href="{{ route('paiements.create', ['reservation_id' => $reservation->id]) }}"
                                    class="btn btn-sm btn-success">💰 Payer</a>
                            @endif
                        @endif
                        <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Supprimer cette réservation ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Aucune réservation trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection