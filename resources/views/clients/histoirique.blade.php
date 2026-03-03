@extends('layouts.main')

@section('title', 'Historique du Client')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-history mr-2"></i>
            Historique de {{ $client->prenom }} {{ $client->nom }}
        </h3>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Nom complet</th>
                        <td>{{ $client->prenom }} {{ $client->nom }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $client->email }}</td>
                    </tr>
                    <tr>
                        <th>Téléphone</th>
                        <td>{{ $client->telephone }}</td>
                    </tr>
                    <tr>
                        <th>CIN</th>
                        <td>{{ $client->cin }}</td>
                    </tr>
                    <tr>
                        <th>Nationalité</th>
                        <td>{{ $client->nationalite ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Adresse</th>
                        <td>{{ $client->adresse ?? '—' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <h4><i class="fas fa-calendar-alt mr-2"></i>Réservations</h4>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Chambre</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Montant</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($client->reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>N° {{ $reservation->chambre->numero }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}</td>
                    <td>{{ number_format($reservation->montant_total, 2) }} Ar</td>
                    <td>
                        @if($reservation->statut == 'confirmee')
                            <span class="badge badge-success">Confirmée</span>
                        @elseif($reservation->statut == 'annulee')
                            <span class="badge badge-danger">Annulée</span>
                        @else
                            <span class="badge badge-secondary">Terminée</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Aucune réservation pour ce client
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection             