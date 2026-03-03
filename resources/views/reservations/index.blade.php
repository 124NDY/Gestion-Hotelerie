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
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
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
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Aucune réservation trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $reservations->links() }}
    </div>
</div>
@endsection