@extends('layouts.main')

@section('title', 'Liste des Factures')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-file-invoice mr-2"></i>Liste des Factures</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>N° Facture</th>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Montant Total</th>
                    <th>Date Émission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($factures as $facture)
                <tr>
                    <td>{{ $facture->id }}</td>
                    <td><strong>{{ $facture->numero_facture }}</strong></td>
                    <td>
                        {{ $facture->reservation->client->prenom }} 
                        {{ $facture->reservation->client->nom }}
                    </td>
                    <td>Chambre N° {{ $facture->reservation->chambre->numero }}</td>
                    <td><strong>{{ number_format($facture->montant_total, 2) }} Ar</strong></td>
                    <td>{{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('factures.pdf', $facture->id) }}" 
                           class="btn btn-danger btn-sm">
                            <i class="fas fa-file-pdf"></i> Télécharger PDF
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        <i class="fas fa-info-circle"></i> Aucune facture trouvée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $factures->links() }}
    </div>
</div>
@endsection