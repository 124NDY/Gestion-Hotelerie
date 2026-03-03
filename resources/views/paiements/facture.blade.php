@extends('layouts.app')

@section('title', 'Facture')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">🧾 Facture #{{ $paiement->id }}</h4>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Imprimer</button>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">⬅️ Retour</a>
    </div>
</div>

<div class="card shadow-sm border-0" id="facture">
    <div class="card-body p-5">

        <!-- En-tête Facture -->
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="fw-bold text-primary">🏨 GestionHotel</h2>
                <p class="text-muted mb-0">Système de Gestion Hôtelière</p>
                <p class="text-muted mb-0">Antananarivo, Madagascar</p>
                <p class="text-muted">Tel: +261 34 00 000 00</p>
            </div>
            <div class="col-md-6 text-end">
                <h3 class="fw-bold">FACTURE</h3>
                <p class="mb-1"><strong>N° :</strong> FAC-{{ str_pad($paiement->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="mb-1"><strong>Date :</strong> {{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</p>
                <span class="badge bg-success fs-6">✅ Payé</span>
            </div>
        </div>

        <hr>

        <!-- Infos Client -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="fw-bold text-muted">FACTURÉ À :</h6>
                <h5 class="fw-bold">{{ $paiement->reservation->client->nom }} {{ $paiement->reservation->client->prenom }}</h5>
                <p class="mb-1">{{ $paiement->reservation->client->email }}</p>
                <p class="mb-1">{{ $paiement->reservation->client->telephone }}</p>
                <p class="mb-0">CIN : {{ $paiement->reservation->client->cin }}</p>
            </div>
            <div class="col-md-6 text-end">
                <h6 class="fw-bold text-muted">DÉTAILS SÉJOUR :</h6>
                <p class="mb-1"><strong>Chambre :</strong> {{ $paiement->reservation->chambre->numero }} - {{ ucfirst($paiement->reservation->chambre->type) }}</p>
                <p class="mb-1"><strong>Arrivée :</strong> {{ \Carbon\Carbon::parse($paiement->reservation->date_arrivee)->format('d/m/Y') }}</p>
                <p class="mb-1"><strong>Départ :</strong> {{ \Carbon\Carbon::parse($paiement->reservation->date_depart)->format('d/m/Y') }}</p>
                @php
                    $nuits = \Carbon\Carbon::parse($paiement->reservation->date_arrivee)->diffInDays(\Carbon\Carbon::parse($paiement->reservation->date_depart));
                @endphp
                <p class="mb-0"><strong>Durée :</strong> {{ $nuits }} nuit(s)</p>
            </div>
        </div>

        <!-- Tableau Détails -->
        <table class="table table-bordered mb-4">
            <thead class="table-dark">
                <tr>
                    <th>Description</th>
                    <th class="text-center">Nuits</th>
                    <th class="text-end">Prix/Nuit</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Chambre {{ $paiement->reservation->chambre->numero }}
                        ({{ ucfirst($paiement->reservation->chambre->type) }})
                    </td>
                    <td class="text-center">{{ $nuits }}</td>
                    <td class="text-end">{{ number_format($paiement->reservation->chambre->prix, 0, ',', ' ') }} Ar</td>
                    <td class="text-end fw-bold">{{ number_format($paiement->montant, 0, ',', ' ') }} Ar</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="table-success">
                    <td colspan="3" class="text-end fw-bold fs-5">TOTAL</td>
                    <td class="text-end fw-bold fs-5">{{ number_format($paiement->montant, 0, ',', ' ') }} Ar</td>
                </tr>
            </tfoot>
        </table>

        <!-- Mode Paiement -->
        <div class="row">
            <div class="col-md-6">
                <p><strong>Mode de paiement :</strong> {{ ucfirst($paiement->mode_paiement) }}</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="text-muted small">Merci pour votre confiance !</p>
                <p class="text-muted small">GestionHotel — Antananarivo</p>
            </div>
        </div>

    </div>
</div>

<style>
@media print {
    .sidebar, .navbar-top, .btn, .alert { display: none !important; }
    .main-content { margin-left: 0 !important; }
    #facture { box-shadow: none !important; }
}
</style>

@endsection