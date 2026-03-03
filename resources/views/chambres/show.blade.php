@extends('layouts.main')

@section('title', 'Détail Chambre')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-bed mr-2"></i>Chambre N° {{ $chambre->numero }}</h3>
        <div>
            <a href="{{ route('chambres.edit', $chambre->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('chambres.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 200px">Numéro</th>
                <td>{{ $chambre->numero }}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{ ucfirst($chambre->type) }}</td>
            </tr>
            <tr>
                <th>Prix par nuit</th>
                <td><strong>{{ number_format($chambre->prix_nuit, 2) }} Ar</strong></td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>
                    @if($chambre->statut == 'disponible')
                        <span class="badge badge-success">✅ Disponible</span>
                    @else
                        <span class="badge badge-danger">🔴 Occupée</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $chambre->description ?? '—' }}</td>
            </tr>
            <tr>
                <th>Créée le</th>
                <td>{{ \Carbon\Carbon::parse($chambre->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection