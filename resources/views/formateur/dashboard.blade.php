@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-6">👨‍🏫 Dashboard Formateur</h1>

<!-- Statistiques -->
<div class="grid grid-cols-2 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-blue-800">{{ $workshops->count() }}</p>
        <p class="text-gray-600 mt-1">Mes Workshops</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-green-600">{{ $totalInscrits }}</p>
        <p class="text-gray-600 mt-1">Total Inscrits</p>
    </div>
</div>

<!-- Mes derniers workshops -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-blue-800">Mes Derniers Workshops</h2>
        <a href="{{ route('formateur.workshops') }}"
           class="text-blue-600 hover:underline text-sm">Voir tout</a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-2">Titre</th>
                <th class="text-left p-2">Date début</th>
                <th class="text-left p-2">Statut</th>
                <th class="text-left p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workshops as $workshop)
            <tr class="border-b">
                <td class="p-2">{{ $workshop->titre }}</td>
                <td class="p-2">{{ $workshop->date_debut }}</td>
                <td class="p-2">
                    <span class="px-2 py-1 text-xs rounded
                        {{ $workshop->statut == 'ouvert' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($workshop->statut) }}
                    </span>
                </td>
                <td class="p-2">
                    <a href="{{ route('formateur.participants', $workshop) }}"
                       class="text-blue-600 hover:underline">
                        Voir participants
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-2 text-center text-gray-500">
                    Aucun workshop créé.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('workshops.create') }}"
   class="bg-blue-800 text-white px-6 py-3 rounded hover:bg-blue-700">
    ➕ Créer un nouveau Workshop
</a>

@endsection