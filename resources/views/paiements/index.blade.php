<<<<<<< HEAD
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
                    <th>Date</th>
=======
@extends('layouts.app')

@section('title', 'Gestion des Paiements')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">💰 Liste des Paiements</h4>
    <a href="{{ route('paiements.historique') }}" class="btn btn-info text-white">📋 Historique</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Mode</th>
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
<<<<<<< HEAD
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
                        </a>
=======
                    <td><strong>{{ $paiement->reservation->client->nom }} {{ $paiement->reservation->client->prenom }}</strong></td>
                    <td>Chambre {{ $paiement->reservation->chambre->numero }}</td>
                    <td class="text-success fw-bold">{{ number_format($paiement->montant, 0, ',', ' ') }} Ar</td>
                    <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($paiement->mode_paiement) }}</td>
                    <td>
                        @if($paiement->statut == 'paye')
                            <span class="badge bg-success">✅ Payé</span>
                        @elseif($paiement->statut == 'en_attente')
                            <span class="badge bg-warning text-dark">⏳ En attente</span>
                        @else
                            <span class="badge bg-danger">↩️ Remboursé</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('paiements.facture', $paiement) }}" class="btn btn-sm btn-primary">🧾 Facture</a>
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                    </td>
                </tr>
                @empty
                <tr>
<<<<<<< HEAD
                    <td colspan="8" class="text-center text-muted">Aucun paiement trouvé</td>
=======
                    <td colspan="8" class="text-center text-muted py-4">Aucun paiement trouvé</td>
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                </tr>
                @endforelse
            </tbody>
        </table>
<<<<<<< HEAD

        {{ $paiements->links() }}
    </div>
</div>
=======
    </div>
</div>

>>>>>>> b336feec924672af61f2f862ed61714546fd3112
@endsection