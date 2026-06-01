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

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($workshops as $workshop)
        <div class="bg-white rounded-lg shadow p-5">
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
    @empty
        <p class="text-gray-500 col-span-3 text-center">Aucun workshop disponible.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $workshops->links() }}
</div>

@endsection