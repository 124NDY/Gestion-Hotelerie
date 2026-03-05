<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body x-data="{ darkMode: false, sidebarOpen: true }" :class="darkMode ? 'dark bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-800'" class="min-h-screen flex">

    <!-- Sidebar qui pousse le contenu -->
    <aside :class="sidebarOpen ? 'w-72' : 'w-0'"
           class="flex-shrink-0 bg-gray-900 text-white flex flex-col min-h-screen overflow-hidden transition-all duration-300 ease-in-out">

        <!-- Contenu sidebar dans un conteneur de largeur fixe pour eviter le retrecissement -->
        <div class="w-72 flex flex-col min-h-screen">

            <!-- Logo -->
            <div class="p-6 border-b border-gray-700 pl-14">
                <h1 class="text-xl font-bold text-yellow-400">Laravel Hotel</h1>
                <p class="text-xs text-gray-400 mt-1">Gestion Hoteliere</p>
            </div>

            <!-- Profil utilisateur -->
            <div class="p-4 border-b border-gray-700">
                <a href="{{ route('profil.edit') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                    <img src="{{ auth()->user()->photo_url === 'default_user.jpg'
                        ? asset('images/default_user.jpg')
                        : asset('storage/' . auth()->user()->photo_url) }}"
                         class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400"
                         alt="Photo profil">
                    <div>
                        <p class="text-sm font-semibold">{{ auth()->user()->nom }}</p>
                        <p class="text-xs text-yellow-400 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->routeIs('dashboard') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'text-gray-300' }}">
                    Tableau de bord
                </a>
                <a href="{{ route('rooms.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->routeIs('rooms.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'text-gray-300' }}">
                    Chambres
                </a>
                <a href="{{ route('bookings.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->routeIs('bookings.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'text-gray-300' }}">
                    Reservations
                </a>
                @if(auth()->user()->isAdmin() || auth()->user()->isReceptionniste())
                <a href="{{ route('payments.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->routeIs('payments.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'text-gray-300' }}">
                    Paiements
                </a>
                @endif

                @if(auth()->user()->isAdmin() || auth()->user()->isReceptionniste())
                <a href="{{ route('reviews.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->routeIs('reviews.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'text-gray-300' }}">
                    Avis Clients
                </a>
                @endif
                
                @if(auth()->user()->isAdmin())
                <a href="{{ route('users.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->routeIs('users.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'text-gray-300' }}">
                    Utilisateurs
                </a>
                @endif
            </nav>

            <!-- Bas de sidebar -->
            <div class="p-4 border-t border-gray-700 space-y-2">
                <button @click="darkMode = !darkMode"
                        class="w-full text-left px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-gray-700 transition">
                    <span x-text="darkMode ? 'Mode Clair' : 'Mode Sombre'"></span>
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-lg text-sm text-red-400 hover:bg-gray-700 transition">
                        Deconnexion
                    </button>
                </form>
            </div>

        </div>
    </aside>

    <!-- Bouton toggle fixe -->
    <button @click="sidebarOpen = !sidebarOpen"
            class="fixed top-4 left-4 z-50 w-10 h-10 bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-full shadow-lg flex items-center justify-center transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Topbar -->
        <header class="bg-white dark:bg-gray-800 shadow-sm pl-16 pr-6 py-4 flex items-center justify-end">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">@yield('page-title', 'Dashboard')</h2>
        </header>

        <!-- Alertes -->
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-800 px-4 py-3 rounded-lg mb-4">
                    {{ session('info') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Page content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>