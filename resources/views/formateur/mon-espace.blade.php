@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-6">🎓 Mon Espace</h1>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-bold text-blue-800 mb-4">Mes Inscriptions</h2>

    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">Workshop</th>
                <th class="text-left p-3">Date</th>
                <th class="text-left p-3">Lieu</th>
                <th class="text-left p-3">Statut</th>
                <th class="text-left p-3">Certificat</th>
                <th class="text-left p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscriptions as $inscription)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-medium">{{ $inscription->workshop->titre }}</td>
                <td class="p-3">{{ $inscription->workshop->date_debut }}</td>
                <td class="p-3">{{ $inscription->workshop->lieu }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded
                        {{ $inscription->statut == 'confirmee' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($inscription->statut) }}
                    </span>
                </td>
                <td class="p-3">
                    @if($inscription->certificat)
                        <a href="{{ route('certificat.download', $inscription->certificat) }}"
                           class="text-blue-600 hover:underline">
                            📄 Télécharger
                        </a>
                    @else
                        <span class="text-gray-400 text-xs">Non disponible</span>
                    @endif
                </td>
                <td class="p-3">
                    <form method="POST"
                          action="{{ route('inscription.destroy', $inscription) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-500 hover:underline text-xs"
                                onclick="return confirm('Annuler cette inscription ?')">
                            Annuler
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-3 text-center text-gray-500">
                    Vous n'avez aucune inscription.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('home') }}"
   class="mt-4 inline-block text-blue-600 hover:underline">
    ← Voir les workshops
</a>

@endsection