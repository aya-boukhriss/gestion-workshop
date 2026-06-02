@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-6">🏷️ Gestion des Catégories</h1>

<!-- Formulaire ajout catégorie -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-lg font-bold text-blue-800 mb-4">Ajouter une catégorie</h2>
    <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-4 items-end">
        @csrf
        <div class="flex-1">
            <label class="block text-gray-700 font-bold mb-2">Nom</label>
            <input type="text" name="nom" placeholder="Ex: Informatique, Design, Marketing..."
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
        </div>
        <div>
            <label class="block text-gray-700 font-bold mb-2">Couleur</label>
            <input type="color" name="couleur" value="#3B82F6"
                class="h-10 w-16 border rounded cursor-pointer">
        </div>
        <button type="submit"
            class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-700">
            Ajouter
        </button>
    </form>
</div>

<!-- Liste des catégories -->
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-bold text-blue-800 mb-4">Liste des catégories</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">Couleur</th>
                <th class="text-left p-3">Nom</th>
                <th class="text-left p-3">Workshops</th>
                <th class="text-left p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $categorie)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">
                    <span class="inline-block w-6 h-6 rounded-full"
                          style="background-color: {{ $categorie->couleur }}">
                    </span>
                </td>
                <td class="p-3 font-medium">{{ $categorie->nom }}</td>
                <td class="p-3">{{ $categorie->workshops_count }} workshops</td>
                <td class="p-3">
                    <form method="POST" action="{{ route('admin.categories.destroy', $categorie) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-xs"
                            onclick="return confirm('Supprimer cette catégorie ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-center text-gray-500">
                    Aucune catégorie créée.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('admin.dashboard') }}"
   class="mt-4 inline-block text-blue-600 hover:underline">
    ← Retour au dashboard
</a>

@endsection