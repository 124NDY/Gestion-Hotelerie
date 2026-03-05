<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Hotel - Bienvenue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        }
        .gold { color: #F59E0B; }
        .bg-gold { background-color: #F59E0B; }
        .hover-gold:hover { background-color: #D97706; }
    </style>
</head>
<body class="bg-gray-950 text-white">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-950 bg-opacity-90 backdrop-blur-sm border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold gold">Laravel Hotel</h1>
                <p class="text-xs text-gray-400 -mt-1">Experience Prestige</p>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="#chambres" class="text-sm text-gray-300 hover:text-yellow-400 transition">Chambres</a>
                <a href="#avantages" class="text-sm text-gray-300 hover:text-yellow-400 transition">Services</a>
                <a href="#contact" class="text-sm text-gray-300 hover:text-yellow-400 transition">Contact</a>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-gold hover-gold text-gray-900 font-semibold px-5 py-2 rounded-lg text-sm transition">
                        Mon espace
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm text-gray-300 hover:text-yellow-400 transition px-4 py-2">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-gold hover-gold text-gray-900 font-semibold px-5 py-2 rounded-lg text-sm transition">
                        Reserver
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 w-72 h-72 bg-yellow-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-blue-600 rounded-full blur-3xl"></div>
        </div>
        <div class="relative text-center max-w-4xl mx-auto px-6">
            <p class="text-yellow-400 text-sm font-medium tracking-widest uppercase mb-4">Bienvenue a Laravel Hotel</p>
            <h2 class="text-5xl md:text-7xl font-bold text-white leading-tight mb-6">
                L'Art de Vivre<br>
                <span class="gold">le Luxe</span>
            </h2>
            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
                Découvrez un séjour d'exception au coeur de Paris. Chambres raffinées, service personnalisé et expériences inoubliables.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                   class="bg-gold hover-gold text-gray-900 font-semibold px-8 py-4 rounded-lg text-base transition">
                    Reserver maintenant
                </a>
                <a href="#chambres"
                   class="border border-gray-600 hover:border-yellow-400 text-gray-300 hover:text-yellow-400 font-medium px-8 py-4 rounded-lg text-base transition">
                    Voir les chambres
                </a>
            </div>
        </div>
    </section>

    <!-- Avantages -->
    <section id="avantages" class="py-24 bg-gray-900">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-yellow-400 text-sm tracking-widest uppercase mb-3">Nos Services</p>
                <h2 class="text-4xl font-bold text-white">Une Experience Complete</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 hover:border-yellow-400 transition">
                    <div class="w-12 h-12 bg-yellow-400 bg-opacity-20 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Chambres de Prestige</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Des suites luxueuses finement décorées pour un confort absolu. Chaque détail a été pensé pour votre bien-être.</p>
                </div>
                <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 hover:border-yellow-400 transition">
                    <div class="w-12 h-12 bg-yellow-400 bg-opacity-20 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Service 24h/24</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Notre équipe dédiée est disponible à toute heure pour répondre à vos besoins et rendre votre séjour parfait.</p>
                </div>
                <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 hover:border-yellow-400 transition">
                    <div class="w-12 h-12 bg-yellow-400 bg-opacity-20 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Experience Unique</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Spa, restaurant gastronomique, piscine panoramique. Vivez des moments d'exception durant votre séjour.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Galerie Chambres -->
    <section id="chambres" class="py-24 bg-gray-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-yellow-400 text-sm tracking-widest uppercase mb-3">Nos Chambres</p>
                <h2 class="text-4xl font-bold text-white">Choisissez Votre Havre</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                <div class="group relative rounded-2xl overflow-hidden bg-gray-800 border border-gray-700 hover:border-yellow-400 transition">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('storage/' . $room->photo_url) }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                             alt="Chambre {{ $room->numero }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>
                        <div class="absolute top-3 right-3">
                            @if($room->statut === 'disponible')
                                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Disponible</span>
                            @else
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">Indisponible</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-semibold text-white">Chambre {{ $room->numero }}</h3>
                            <span class="text-yellow-400 font-bold text-sm">{{ number_format($room->prix_nuit, 0) }} $/nuit</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-3">{{ $room->type }}</p>
                        <p class="text-xs text-gray-500 line-clamp-2 mb-4">{{ $room->description }}</p>
                        @if($room->statut === 'disponible')
                        <a href="{{ route('register') }}"
                           class="block text-center bg-gold hover-gold text-gray-900 font-semibold py-2 rounded-lg text-sm transition">
                            Reserver
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact / Footer -->
    <section id="contact" class="py-24 bg-gray-900 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h3 class="text-2xl font-bold gold mb-4">Laravel Hotel</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Un établissement de prestige au coeur de Paris, dédié à l'art de recevoir et à l'excellence du service.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <div class="space-y-2 text-sm text-gray-400">
                        <p>123 Avenue des Palmes, Paris</p>
                        <p>+33 1 23 45 67 89</p>
                        <p>contact@hotelluxe.com</p>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Acces rapide</h4>
                    <div class="space-y-2 text-sm">
                        <a href="{{ route('login') }}" class="block text-gray-400 hover:text-yellow-400 transition">Connexion</a>
                        <a href="{{ route('register') }}" class="block text-gray-400 hover:text-yellow-400 transition">Inscription</a>
                        <a href="#chambres" class="block text-gray-400 hover:text-yellow-400 transition">Nos chambres</a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 text-center">
                <p class="text-gray-500 text-sm">2024 Laravel Hotel. Tous droits reserves.</p>
            </div>
        </div>
    </section>

</body>
</html>