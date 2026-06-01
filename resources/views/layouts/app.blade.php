<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Workshops</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-800 text-white px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-xl font-bold">🎓 Workshops</a>
        <div class="flex gap-4">
            @auth
                <a href="/mon-espace" class="hover:underline">Mon Espace</a>
                @if(auth()->user()->isAdmin())
                    <a href="/admin/dashboard" class="hover:underline">Admin</a>
                @endif
                @if(auth()->user()->isFormateur())
                    <a href="/formateur/dashboard" class="hover:underline">Formateur</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Déconnexion</button>
                </form>
            @else
                <a href="/login" class="hover:underline">Login</a>
                <a href="/register" class="hover:underline">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Messages -->
    <div class="max-w-7xl mx-auto mt-4 px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Contenu -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

</body>
</html>