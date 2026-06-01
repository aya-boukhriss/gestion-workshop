@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-4">{{ $workshop->titre }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
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

    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">← Retour au catalogue</a>
</div>

@endsection