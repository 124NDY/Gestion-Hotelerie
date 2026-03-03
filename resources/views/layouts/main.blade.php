<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GestionHotelerie')</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper"></div>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <i class="fas fa-hotel ml-3"></i>
            <span class="brand-text font-weight-bold ml-2">GestionHotelerie</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('chambres.index') }}" class="nav-link {{ request()->routeIs('chambres.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bed"></i>
                            <p>Chambres</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Clients</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reservations.index') }}" class="nav-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Réservations</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('paiements.index') }}" class="nav-link {{ request()->routeIs('paiements.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Paiements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('factures.index') }}" class="nav-link {{ request()->routeIs('factures.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Factures</p>
                        </a>
                    </li>
                </ul>
            </nav>
            {{-- Bouton Mode Sombre en bas de sidebar --}}
            <div class="mt-3 mb-3 mx-3">
                <button id="toggleTheme" class="btn btn-block btn-outline-light btn-sm">
                    🌙 Mode Sombre
                </button>
            </div>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('title')</h1>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @yield('content')

            </div>
        </div>
    </div>
    <footer class="main-footer">
    <strong>GestionHotelerie</strong> &copy; {{ date('Y') }}
</footer>

</div>

<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

<script>
    const btn = document.getElementById('toggleTheme');
    const body = document.body;

    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        btn.textContent = '☀️ Mode Clair';
    }

    btn.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            btn.textContent = '☀️ Mode Clair';
        } else {
            localStorage.setItem('theme', 'light');
            btn.textContent = '🌙 Mode Sombre';
        }
    });
</script>

<style>
    .dark-mode {
        filter: invert(1) hue-rotate(180deg);
    }
    .dark-mode img {
        filter: invert(1) hue-rotate(180deg);
    }
</style>

@stack('scripts')
</body>
</html> 
