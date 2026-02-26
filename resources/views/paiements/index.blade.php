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