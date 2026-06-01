@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-800">📚 Mes Workshops</h1>
    <a href="{{ route('workshops.create') }}"
       class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Créer un Workshop
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">Titre</th>
                <th class="text-left p-3">Date début</th>
                <th class="text-left p-3">Lieu</th>
                <th class="text-left p-3">Capacité</th>
                <th class="text-left p-3">Statut</th>
                <th class="text-left p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workshops as $workshop)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-medium">{{ $workshop->titre }}</td>
                <td class="p-3">{{ $workshop->date_debut }}</td>
                <td class="p-3">{{ $workshop->lieu }}</td>
                <td class="p-3">{{ $workshop->capacite }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded
                        {{ $workshop->statut == 'ouvert' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($workshop->statut) }}
                    </span>
                </td>
                <td class="p-3 flex gap-2">
                    <a href="{{ route('workshops.edit', $workshop) }}"
                       class="text-blue-600 hover:underline">Modifier</a>
                    <a href="{{ route('formateur.participants', $workshop) }}"
                       class="text-green-600 hover:underline">Participants</a>
                    <form method="POST" action="{{ route('workshops.destroy', $workshop) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline"
                            onclick="return confirm('Supprimer ce workshop ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-3 text-center text-gray-500">
                    Aucun workshop créé.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $workshops->links() }}
    </div>
</div>

<a href="{{ route('formateur.dashboard') }}"
   class="mt-4 inline-block text-blue-600 hover:underline">
    ← Retour au dashboard
</a>

@endsection