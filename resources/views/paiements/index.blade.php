@extends('layouts.main')

@section('title', 'Liste des Paiements')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-credit-card mr-2"></i>Liste des Paiements</h3>
        <a href="{{ route('paiements.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nouveau Paiement
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Réservation</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Méthode</th>
                    <th>Date</th>                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>Réservation #{{ $paiement->reservation->id }}</td>
                    <td>{{ $paiement->reservation->client->prenom }} {{ $paiement->reservation->client->nom }}</td>
                    <td><strong>{{ number_format($paiement->montant, 2) }} Ar</strong></td>
                    <td>
                        @if($paiement->methode == 'espece')
                            <span class="badge badge-secondary"><i class="fas fa-money-bill"></i> Espèce</span>
                        @elseif($paiement->methode == 'carte')
                            <span class="badge badge-info"><i class="fas fa-credit-card"></i> Carte</span>
                        @else
                            <span class="badge badge-warning"><i class="fas fa-university"></i> Virement</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
                    <td>
                        @if($paiement->statut == 'paye')
                            <span class="badge badge-success">✅ Payé</span>
                        @elseif($paiement->statut == 'en_attente')
                            <span class="badge badge-warning">⏳ En attente</span>
                        @else
                            <span class="badge badge-danger">🔄 Remboursé</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('factures.generer', $paiement->reservation->id) }}" 
                           class="btn btn-success btn-sm">
                            <i class="fas fa-file-pdf"></i> Facture PDF
                        </a>                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Aucun paiement trouvé</td>                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $paiements->links() }}
    </div>
</div>@endsection
