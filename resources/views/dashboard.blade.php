<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
=======
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row g-4 mb-4">
    <!-- Total Chambres -->
    <div class="col-md-3">
        <div class="card card-stat text-white" style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75">Total Chambres</p>
                        <h3 class="fw-bold">{{ $totalChambres }}</h3>
                    </div>
                    <div class="fs-1">🛏️</div>
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</x-app-layout>
=======

    <!-- Chambres Disponibles -->
    <div class="col-md-3">
        <div class="card card-stat text-white" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75">Disponibles</p>
                        <h3 class="fw-bold">{{ $chambresDisponibles }}</h3>
                    </div>
                    <div class="fs-1">✅</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chambres Occupées -->
    <div class="col-md-3">
        <div class="card card-stat text-white" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75">Occupées</p>
                        <h3 class="fw-bold">{{ $chambresOccupees }}</h3>
                    </div>
                    <div class="fs-1">🔴</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Clients -->
    <div class="col-md-3">
        <div class="card card-stat text-white" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75">Total Clients</p>
                        <h3 class="fw-bold">{{ $totalClients }}</h3>
                    </div>
                    <div class="fs-1">👥</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Réservations Actives -->
    <div class="col-md-3">
        <div class="card card-stat text-white" style="background: linear-gradient(135deg, #fa709a, #fee140);">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75">Réservations Actives</p>
                        <h3 class="fw-bold">{{ $reservationsActives }}</h3>
                    </div>
                    <div class="fs-1">📅</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenus -->
    <div class="col-md-3">
        <div class="card card-stat text-white" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75">Total Revenus</p>
                        <h3 class="fw-bold">{{ number_format($totalPaiements, 2) }} Ar</h3>
                    </div>
                    <div class="fs-1">💰</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Raccourcis -->
<div class="card shadow-sm">
    <div class="card-header fw-bold">⚡ Accès Rapide</div>
    <div class="card-body">
        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('chambres.create') }}" class="btn btn-primary">➕ Nouvelle Chambre</a>
            <a href="{{ route('clients.create') }}" class="btn btn-success">➕ Nouveau Client</a>
            <a href="{{ route('reservations.create') }}" class="btn btn-warning">➕ Nouvelle Réservation</a>
            <a href="{{ route('paiements.index') }}" class="btn btn-info text-white">💰 Voir Paiements</a>
        </div>
    </div>
</div>

@endsection
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
