@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">✏️ Modifier le Workshop</h1>

    <form method="POST" action="{{ route('workshops.update', $workshop) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Titre</label>
            <input type="text" name="titre" value="{{ old('titre', $workshop->titre) }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
            @error('titre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" rows="4"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">{{ old('description', $workshop->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Date début</label>
                <input type="date" name="date_debut" value="{{ old('date_debut', $workshop->date_debut) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
                @error('date_debut') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Date fin</label>
                <input type="date" name="date_fin" value="{{ old('date_fin', $workshop->date_fin) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
                @error('date_fin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Lieu</label>
            <input type="text" name="lieu" value="{{ old('lieu', $workshop->lieu) }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
            @error('lieu') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Capacité</label>
            <input type="number" name="capacite" value="{{ old('capacite', $workshop->capacite) }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
            @error('capacite') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Statut</label>
            <select name="statut" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-800">
                <option value="ouvert" {{ $workshop->statut == 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                <option value="complet" {{ $workshop->statut == 'complet' ? 'selected' : '' }}>Complet</option>
                <option value="annule" {{ $workshop->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
                <option value="termine" {{ $workshop->statut == 'termine' ? 'selected' : '' }}>Terminé</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button type="submit"
                class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-700">
                Mettre à jour
            </button>
            <a href="{{ route('workshops.show', $workshop) }}"
                class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection