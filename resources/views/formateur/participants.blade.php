@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-2">
    👥 Participants — {{ $workshop->titre }}
</h1>
<p class="text-gray-500 mb-6">📅 {{ $workshop->date_debut }} | 📍 {{ $workshop->lieu }}</p>

<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">Nom</th>
                <th class="text-left p-3">Email</th>
                <th class="text-left p-3">Date inscription</th>
                <th class="text-left p-3">Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscriptions as $inscription)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $inscription->participant->name }}</td>
                <td class="p-3">{{ $inscription->participant->email }}</td>
                <td class="p-3">{{ $inscription->date_inscription }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded
                        {{ $inscription->statut == 'confirmee' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($inscription->statut) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-center text-gray-500">
                    Aucun participant inscrit.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('formateur.dashboard') }}"
   class="mt-4 inline-block text-blue-600 hover:underline">
    ← Retour au dashboard
</a>

@endsection