@extends('layouts.app')

@section('title', 'Historique des Paiements')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">📋 Historique des Paiements</h4>
    <a href="{{ route('paiements.index') }}" class="btn btn-secondary">⬅️ Retour</a>
</div>

<!-- Statistiques -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
            <div class="card-body">
                <p class="mb-1 opacity-75">Total Encaissé</p>
                <h4 class="fw-bold">{{ number_format($paiements->where('statut', 'paye')->sum('montant'), 0, ',', ' ') }} Ar</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #fa709a, #fee140);">
            <div class="card-body">
                <p class="mb-1 opacity-75">En Attente</p>
                <h4 class="fw-bold">{{ number_format($paiements->where('statut', 'en_attente')->sum('montant'), 0, ',', ' ') }} Ar</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
            <div class="card-body">
                <p class="mb-1 opacity-75">Total Paiements</p>
                <h4 class="fw-bold">{{ $paiements->count() }}</h4>
            </div>
        </div>
    </div>
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
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
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
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Aucun paiement trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection