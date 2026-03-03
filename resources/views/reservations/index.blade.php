<<<<<<< HEAD
@extends('layouts.main')

@section('title', 'Liste des Réservations')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i>Liste des Réservations</h3>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nouvelle Réservation
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
=======
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
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
<<<<<<< HEAD
                    <th>Montant</th>
=======
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
<<<<<<< HEAD
                    <td>{{ $reservation->client->prenom }} {{ $reservation->client->nom }}</td>
                    <td>N° {{ $reservation->chambre->numero }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}</td>
                    <td><strong>{{ number_format($reservation->montant_total, 2) }} Ar</strong></td>
                    <td>
                        @if($reservation->statut == 'confirmee')
                            <span class="badge badge-success">✅ Confirmée</span>
                        @elseif($reservation->statut == 'annulee')
                            <span class="badge badge-danger">❌ Annulée</span>
                        @else
                            <span class="badge badge-secondary">🏁 Terminée</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if($reservation->statut == 'confirmee')
                        <form action="{{ route('reservations.annuler', $reservation->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Annuler cette réservation ?')">
                                <i class="fas fa-ban"></i>
                            </button>
                        </form>
                        @endif
=======
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
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                    </td>
                </tr>
                @empty
                <tr>
<<<<<<< HEAD
                    <td colspan="8" class="text-center text-muted">Aucune réservation trouvée</td>
=======
                    <td colspan="7" class="text-center text-muted py-4">Aucune réservation trouvée</td>
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                </tr>
                @endforelse
            </tbody>
        </table>
<<<<<<< HEAD
        {{ $reservations->links() }}
    </div>
</div>
=======
    </div>
</div>

>>>>>>> b336feec924672af61f2f862ed61714546fd3112
@endsection