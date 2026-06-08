@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-6">📊 Dashboard Manager</h1>

<!-- Statistiques -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-blue-800">{{ $stats['workshops'] }}</p>
        <p class="text-gray-600 mt-1">Workshops</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-green-600">{{ $stats['inscriptions'] }}</p>
        <p class="text-gray-600 mt-1">Inscriptions</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-purple-600">{{ $stats['formateurs'] }}</p>
        <p class="text-gray-600 mt-1">Formateurs</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-orange-500">{{ $stats['participants'] }}</p>
        <p class="text-gray-600 mt-1">Participants</p>
    </div>
</div>

<!-- Liste des workshops -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-blue-800">📚 Tous les Workshops</h2>
        <a href="{{ route('manager.evaluations') }}"
           class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 text-sm">
            ⭐ Voir les Évaluations
        </a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">Titre</th>
                <th class="text-left p-3">Formateur</th>
                <th class="text-left p-3">Date</th>
                <th class="text-left p-3">Inscrits</th>
                <th class="text-left p-3">Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workshops as $workshop)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-medium">{{ $workshop->titre }}</td>
                <td class="p-3">{{ $workshop->formateur->name ?? 'N/A' }}</td>
                <td class="p-3">{{ $workshop->date_debut }}</td>
                <td class="p-3">{{ $workshop->inscriptions->count() }} / {{ $workshop->capacite }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded
                        {{ $workshop->statut == 'ouvert' ? 'bg-green-100 text-green-800' :
                          ($workshop->statut == 'termine' ? 'bg-blue-100 text-blue-800' :
                          'bg-red-100 text-red-800') }}">
                        {{ ucfirst($workshop->statut) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">
                    Aucun workshop.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $workshops->links() }}
    </div>
</div>

@endsection