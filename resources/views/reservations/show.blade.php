@extends('layouts.main')

@section('title', 'Détail Réservation')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i>Réservation #{{ $reservation->id }}</h3>
        <div>
            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-user mr-2"></i>Informations Client</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nom complet</th>
                        <td>{{ $reservation->client->prenom }} {{ $reservation->client->nom }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $reservation->client->email }}</td>
                    </tr>
                    <tr>
                        <th>Téléphone</th>
                        <td>{{ $reservation->client->telephone }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5><i class="fas fa-bed mr-2"></i>Informations Chambre</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Numéro</th>
                        <td>{{ $reservation->chambre->numero }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ ucfirst($reservation->chambre->type) }}</td>
                    </tr>
                    <tr>
                        <th>Prix/Nuit</th>
                        <td>{{ number_format($reservation->chambre->prix_nuit, 2) }} Ar</td>
                    </tr>
                </table>
            </div>
        </div>

        <h5><i class="fas fa-info-circle mr-2"></i>Détails Réservation</h5>
        <table class="table table-bordered">
            <tr>
                <th style="width:200px">Date d'arrivée</th>
                <td>{{ \Carbon\Carbon::parse($reservation->date_arrivee)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Date de départ</th>
                <td>{{ \Carbon\Carbon::parse($reservation->date_depart)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Nombre de nuits</th>
                <td>{{ \Carbon\Carbon::parse($reservation->date_arrivee)->diffInDays($reservation->date_depart) }} nuits</td>
            </tr>
            <tr>
                <th>Montant total</th>
                <td><strong>{{ number_format($reservation->montant_total, 2) }} Ar</strong></td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>
                    @if($reservation->statut == 'confirmee')
                        <span class="badge badge-success">✅ Confirmée</span>
                    @elseif($reservation->statut == 'annulee')
                        <span class="badge badge-danger">❌ Annulée</span>
                    @else
                        <span class="badge badge-secondary">🏁 Terminée</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $reservation->notes ?? '—' }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection