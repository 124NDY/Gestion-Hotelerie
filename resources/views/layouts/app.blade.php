<!DOCTYPE html>
<<<<<<< HEAD
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GestionHotelerie') }}</title>
</head>
<body>
@isset($slot)
    {{ $slot }}
@endisset
=======
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionHotelerie - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background-color: #1a1a2e; width: 250px; position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; }
        .sidebar a { color: #ccc; transition: all 0.3s; text-decoration: none; }
        .sidebar a:hover { color: #fff; background-color: #16213e; }
        .sidebar a.active { color: #fff; background-color: #0f3460; }
        .main-content { background-color: #f8f9fa; min-height: 100vh; margin-left: 250px; }
        .navbar-top { background-color: #fff; border-bottom: 1px solid #dee2e6; }
        .card-stat { border-radius: 10px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <div class="text-center mb-4">
            <h5 class="text-white fw-bold">🏨 GestionHotel</h5>
            <small class="text-muted">{{ auth()->user()->role }}</small>
        </div>
        <hr class="text-muted">
        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link px-3 py-2 rounded {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('chambres.index') }}" class="nav-link px-3 py-2 rounded {{ request()->routeIs('chambres.*') ? 'active' : '' }}">
                    🛏️ Chambres
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('clients.index') }}" class="nav-link px-3 py-2 rounded {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                    👥 Clients
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reservations.index') }}" class="nav-link px-3 py-2 rounded {{ request()->routeIs('reservations.*') ? 'active' : '' }}">
                    📅 Réservations
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('paiements.index') }}" class="nav-link px-3 py-2 rounded {{ request()->routeIs('paiements.*') ? 'active' : '' }}">
                    💰 Paiements
                </a>
            </li>
        </ul>
        <hr class="text-muted">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                🚪 Déconnexion
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <!-- Top Navbar -->
        <div class="navbar-top px-4 py-3 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">@yield('title')</h6>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary">{{ auth()->user()->role }}</span>
                <span class="fw-bold">{{ auth()->user()->name }}</span>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ❌ {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
</body>
</html>