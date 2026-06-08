@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">📚 Catalogue des Workshops</h1>

    @auth
        @if(auth()->user()->isFormateur() || auth()->user()->isAdmin())
            <a href="{{ route('workshops.create') }}"
               class="bg-indigo-600 text-white px-5 py-2 rounded-xl hover:bg-indigo-700 transition">
                + Créer un Workshop
            </a>
        @endif
    @endauth
</div>

<div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
    <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">

        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="🔍 Rechercher..."
               class="w-full border rounded-xl px-3 py-2">

        <input type="text"
               name="lieu"
               value="{{ request('lieu') }}"
               placeholder="📍 Lieu..."
               class="w-full border rounded-xl px-3 py-2">

        <input type="date"
               name="date"
               value="{{ request('date') }}"
               class="w-full border rounded-xl px-3 py-2">

        <select name="categorie"
                class="w-full border rounded-xl px-3 py-2">

            <option value="">Toutes les catégories</option>

            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}"
                    {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
            @endforeach

        </select>

        <div class="flex gap-2">
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 w-full">
                Rechercher
            </button>

            <a href="{{ route('home') }}"
               class="bg-gray-200 px-4 py-2 rounded-xl text-center w-full hover:bg-gray-300">
                Reset
            </a>
        </div>

    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@forelse($workshops as $workshop)

<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">

    @if($workshop->photo)
        <img src="{{ asset('storage/' . $workshop->photo) }}"
             alt="{{ $workshop->titre }}"
             class="w-full h-52 object-cover">
    @else
        <div class="w-full h-52 bg-indigo-100 flex items-center justify-center">
            <span class="text-5xl">🎓</span>
        </div>
    @endif

    <div class="p-5">

        @if($workshop->categorie)
            <span
                class="inline-block px-3 py-1 text-xs rounded-full text-white mb-3"
                style="background-color: {{ $workshop->categorie->couleur }}">
                {{ $workshop->categorie->nom }}
            </span>
        @endif

        <h2 class="text-xl font-bold text-slate-800 mb-2">
            {{ $workshop->titre }}
        </h2>

        <p class="text-gray-600 mb-4">
            {{ Str::limit($workshop->description, 100) }}
        </p>

        <div class="text-sm text-gray-500 space-y-1 mb-4">
            <p>📅 {{ $workshop->date_debut }}</p>
            <p>📍 {{ $workshop->lieu }}</p>
            <p>👥 {{ $workshop->capacite }} places</p>
            <p>👨‍🏫 {{ $workshop->formateur->name ?? 'N/A' }}</p>
        </div>

        <div class="mb-4">
            @if($workshop->statut == 'ouvert')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                    Ouvert
                </span>
            @elseif($workshop->statut == 'annule')
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                    Annulé
                </span>
            @elseif($workshop->statut == 'complet')
                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs">
                    Complet
                </span>
            @else
                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs">
                    Terminé
                </span>
            @endif
        </div>

        <div class="flex gap-2">

            <a href="{{ route('workshops.show', $workshop) }}"
               class="flex-1 text-center bg-indigo-600 text-white py-2 rounded-xl hover:bg-indigo-700 transition">
                Voir détails
            </a>

            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->id == $workshop->id_formateur)
                    <a href="{{ route('workshops.edit', $workshop) }}"
                       class="bg-emerald-600 text-white px-4 py-2 rounded-xl hover:bg-emerald-700 transition">
                        Modifier
                    </a>
                @endif
            @endauth

        </div>

    </div>

</div>

@empty

<p class="text-center col-span-3 text-gray-500">
    Aucun workshop disponible.
</p>

@endforelse

</div>

<div class="mt-8">
    {{ $workshops->links() }}
</div>

@endsection