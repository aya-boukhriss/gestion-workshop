<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Gestion Workshops</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md">

    <!-- Logo & Titre -->
    <div class="text-center mb-8">
        <div class="text-6xl mb-4">🎓</div>
        <h1 class="text-3xl font-bold text-blue-800">Gestion Workshops</h1>
        <p class="text-gray-500 mt-2">Connectez-vous à votre espace</p>
    </div>

    <!-- Carte login -->
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <!-- Message erreur session -->
        @if (session('status'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2">📧 Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-800 transition"
                    placeholder="votre@email.com" required autofocus>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2">🔒 Mot de passe</label>
                <input type="password" name="password"
                    class="w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-800 transition"
                    placeholder="••••••••" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 text-gray-600">
                    <input type="checkbox" name="remember" class="rounded">
                    Se souvenir de moi
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-blue-600 hover:underline text-sm">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <!-- Bouton connexion -->
            <button type="submit"
                class="w-full bg-blue-800 text-white py-3 rounded-lg font-bold text-lg hover:bg-blue-700 transition">
                Se connecter
            </button>
        </form>

        <!-- Lien register -->
        <div class="text-center mt-6 text-gray-500">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-bold">
                S'inscrire
            </a>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-6 text-gray-400 text-sm">
        © 2026 Gestion Workshops — HEEC Marrakech
    </div>

</div>

</body>
</html>