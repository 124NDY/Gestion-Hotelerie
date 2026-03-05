<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Laravel Hotel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        h1, h2 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-gray-950 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-6">

        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/">
                <h1 class="text-3xl font-bold text-yellow-400">Laravel Hotel</h1>
                <p class="text-gray-400 text-sm mt-1">Experience Prestige</p>
            </a>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 shadow-2xl">
            <h2 class="text-xl font-semibold text-white mb-6">Connexion</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Adresse email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-1">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-600 bg-gray-800 text-yellow-400">
                        Se souvenir de moi
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-yellow-400 hover:text-yellow-300 transition">
                        Mot de passe oublie ?
                    </a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 rounded-lg transition">
                    Se connecter
                </button>

                <p class="text-center text-sm text-gray-400">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-300 transition">
                        S'inscrire
                    </a>
                </p>
            </form>
        </div>

        <p class="text-center text-xs text-gray-600 mt-6">
            <a href="/" class="hover:text-gray-400 transition">Retour a l'accueil</a>
        </p>
    </div>

</body>
</html>