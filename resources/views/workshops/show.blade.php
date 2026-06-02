@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-4">{{ $workshop->titre }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            @if($workshop->photo)
                <img src="{{ asset('storage/' . $workshop->photo) }}"
                     alt="{{ $workshop->titre }}"
                     class="w-full h-48 object-cover rounded-lg mb-4">
            @endif
            <p class="text-gray-700 mb-4">{{ $workshop->description }}</p>
            <div class="text-sm text-gray-600 space-y-2">
                <p>📅 <strong>Début :</strong> {{ $workshop->date_debut }}</p>
                <p>📅 <strong>Fin :</strong> {{ $workshop->date_fin }}</p>
                <p>📍 <strong>Lieu :</strong> {{ $workshop->lieu }}</p>
                <p>👥 <strong>Capacité :</strong> {{ $workshop->capacite }} places</p>
                <p>👨‍🏫 <strong>Formateur :</strong> {{ $workshop->formateur->name ?? 'N/A' }}</p>
                <p>
                    <strong>Statut :</strong>
                    <span class="px-2 py-1 text-xs rounded
                        {{ $workshop->statut == 'ouvert' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($workshop->statut) }}
                    </span>
                </p>
            </div>
        </div>

        <div class="flex flex-col justify-center items-center">
            @auth
                @if($dejaInscrit)
                    <p class="text-green-600 font-bold mb-2">✅ Vous êtes inscrit</p>
                @elseif($workshop->statut == 'ouvert')
                    <form method="POST" action="{{ route('inscription.store', $workshop) }}">
                        @csrf
                        <button type="submit"
                            class="bg-blue-800 text-white px-6 py-3 rounded-lg hover:bg-blue-700 text-lg">
                            S'inscrire au Workshop
                        </button>
                    </form>
                @else
                    <p class="text-red-500">Ce workshop n'accepte plus d'inscriptions.</p>
                @endif
            @else
                <a href="/login" class="bg-blue-800 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Connectez-vous pour s'inscrire
                </a>
            @endauth
        </div>
    </div>

    <!-- Évaluations -->
    @php
    $evaluations = $workshop->inscriptions->filter(fn($i) => $i->evaluation)->map(fn($i) => $i->evaluation);
    $moyenne = $evaluations->avg('note');
    @endphp

    @if($evaluations->count() > 0)
    <div class="mt-6 bg-gray-50 rounded-lg p-4">
        <h3 class="text-lg font-bold text-blue-800 mb-3">⭐ Évaluations des participants</h3>
        <div class="flex items-center gap-3 mb-4">
            <span class="text-3xl font-bold text-yellow-500">{{ number_format($moyenne, 1) }}</span>
            <div>
                <div class="flex gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="text-yellow-400 text-xl">{{ $i <= round($moyenne) ? '⭐' : '☆' }}</span>
                    @endfor
                </div>
                <span class="text-sm text-gray-500">{{ $evaluations->count() }} avis</span>
            </div>
        </div>
        @foreach($evaluations as $eval)
        <div class="border-b pb-3 mb-3">
            <div class="flex gap-1 mb-1">
                @for($i = 1; $i <= 5; $i++)
                    <span class="text-yellow-400">{{ $i <= $eval->note ? '⭐' : '☆' }}</span>
                @endfor
            </div>
            @if($eval->commentaire)
                <p class="text-gray-600 text-sm">{{ $eval->commentaire }}</p>
            @endif
            <p class="text-gray-400 text-xs mt-1">{{ $eval->date }}</p>
        </div>
        @endforeach
    </div>
    @endif

    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">← Retour au catalogue</a>
</div>

@endsection