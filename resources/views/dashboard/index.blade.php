@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

{{-- Statistiques --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['chambres_disponibles'] }}</h3>
                <p>Chambres Disponibles</p>
            </div>
            <div class="icon"><i class="fas fa-bed"></i></div>
            <a href="{{ route('chambres.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['chambres_occupees'] }}</h3>
                <p>Chambres Occupées</p>
            </div>
            <div class="icon"><i class="fas fa-door-closed"></i></div>
            <a href="{{ route('chambres.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_clients'] }}</h3>
                <p>Total Clients</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('clients.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($stats['revenus_mois'], 2) }} Ar</h3>
                <p>Revenus ce mois</p>
            </div>
            <div class="icon"><i class="fas fa-dollar-sign"></i></div>
            <a href="{{ route('paiements.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    {{-- Graphique --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i>Réservations par mois ({{ date('Y') }})
                </h3>
            </div>
            <div class="card-body">
                <canvas id="reservationsChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Résumé --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Résumé</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Réservations confirmées</span>
                        <span class="badge badge-success">{{ $stats['reservations_confirmees'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Arrivées aujourd'hui</span>
                        <span class="badge badge-info">{{ $stats['reservations_today'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Chambres disponibles</span>
                        <span class="badge badge-primary">{{ $stats['chambres_disponibles'] }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Dernières réservations --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i>Dernières Réservations</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Montant</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dernieres_reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->client->prenom }} {{ $reservation->client->nom }}</td>
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
                    <td colspan="7" class="text-center text-muted">Aucune réservation</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('reservationsChart').getContext('2d');

    const labels = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];
    const data   = Array(12).fill(0);

    @foreach($reservations_mois as $item)
        data[{{ $item->mois - 1 }}] = {{ $item->total }};
    @endforeach

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Réservations',
                data: data,
                backgroundColor: 'rgba(60, 141, 188, 0.8)',
                borderColor: 'rgba(60, 141, 188, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endpush