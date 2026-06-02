@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-800">📚 Catalogue des Workshops</h1>
    @auth
        @if(auth()->user()->isFormateur() || auth()->user()->isAdmin())
            <a href="{{ route('workshops.create') }}"
               class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Créer un Workshop
            </a>
        @endif
    @endauth
</div>

<!-- Barre de recherche et filtres -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="🔍 Rechercher..."
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
        </div>
        <div>
            <input type="text" name="lieu" value="{{ request('lieu') }}"
                placeholder="📍 Lieu..."
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
        </div>
        <div>
            <input type="date" name="date" value="{{ request('date') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
        </div>
        <div>
            <select name="categorie"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
                <option value="">🏷️ Toutes les catégories</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}"
                        {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit"
                class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                Rechercher
            </button>
            <a href="{{ route('home') }}"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 text-center w-full">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($workshops as $workshop)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($workshop->photo)
                <img src="{{ asset('storage/' . $workshop->photo) }}"
                     alt="{{ $workshop->titre }}"
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-blue-100 flex items-center justify-center">
                    <span class="text-blue-400 text-4xl">🎓</span>
                </div>
            @endif

            <div class="p-5">
                @if($workshop->categorie)
                    <span class="inline-block px-2 py-1 text-xs rounded-full text-white mb-2"
                          style="background-color: {{ $workshop->categorie->couleur }}">
                        {{ $workshop->categorie->nom }}
                    </span>
                @endif
                <h2 class="text-lg font-bold text-blue-800 mb-2">{{ $workshop->titre }}</h2>
                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($workshop->description, 100) }}</p>
                <div class="text-sm text-gray-500 mb-3">
                    <p>📅 {{ $workshop->date_debut }}</p>
                    <p>📍 {{ $workshop->lieu }}</p>
                    <p>👥 Capacité : {{ $workshop->capacite }}</p>
                    <p>👨‍🏫 {{ $workshop->formateur->name ?? 'N/A' }}</p>
                </div>
                <span class="inline-block px-2 py-1 text-xs rounded
                    {{ $workshop->statut == 'ouvert' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($workshop->statut) }}
                </span>
                <a href="{{ route('workshops.show', $workshop) }}"
                   class="block mt-3 text-center bg-blue-800 text-white py-2 rounded hover:bg-blue-700">
                    Voir détails
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500 col-span-3 text-center">Aucun workshop disponible.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $workshops->links() }}
</div>

@endsection