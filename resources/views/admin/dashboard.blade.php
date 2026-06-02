@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-6">🛠️ Dashboard Admin</h1>

<!-- Statistiques -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-blue-800">{{ $stats['users'] }}</p>
        <p class="text-gray-600 mt-1">Utilisateurs</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-green-600">{{ $stats['workshops'] }}</p>
        <p class="text-gray-600 mt-1">Workshops</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-orange-500">{{ $stats['inscriptions'] }}</p>
        <p class="text-gray-600 mt-1">Inscriptions</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center">
        <p class="text-3xl font-bold text-purple-600">{{ $stats['formateurs'] }}</p>
        <p class="text-gray-600 mt-1">Formateurs</p>
    </div>
</div>

<!-- Derniers workshops -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-blue-800">Derniers Workshops</h2>
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline text-sm">Voir tout</a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-2">Titre</th>
                <th class="text-left p-2">Formateur</th>
                <th class="text-left p-2">Date</th>
                <th class="text-left p-2">Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentWorkshops as $workshop)
            <tr class="border-b">
                <td class="p-2">{{ $workshop->titre }}</td>
                <td class="p-2">{{ $workshop->formateur->name ?? 'N/A' }}</td>
                <td class="p-2">{{ $workshop->date_debut }}</td>
                <td class="p-2">
                    <span class="px-2 py-1 text-xs rounded
                        {{ $workshop->statut == 'ouvert' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($workshop->statut) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Boutons actions -->
<div class="flex gap-4">
    <a href="{{ route('admin.users') }}"
       class="bg-blue-800 text-white px-6 py-3 rounded hover:bg-blue-700">
        👥 Gérer les Utilisateurs
    </a>
    <a href="{{ route('admin.categories') }}"
       class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
        🏷️ Gérer les Catégories
    </a>
</div>

@endsection