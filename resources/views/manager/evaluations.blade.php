@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-6">⭐ Évaluations des Workshops</h1>

<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">Participant</th>
                <th class="text-left p-3">Workshop</th>
                <th class="text-left p-3">Formateur</th>
                <th class="text-left p-3">Note</th>
                <th class="text-left p-3">Commentaire</th>
                <th class="text-left p-3">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($evaluations as $evaluation)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $evaluation->inscription->participant->name ?? 'N/A' }}</td>
                <td class="p-3 font-medium">{{ $evaluation->inscription->workshop->titre ?? 'N/A' }}</td>
                <td class="p-3">{{ $evaluation->inscription->workshop->formateur->name ?? 'N/A' }}</td>
                <td class="p-3">
                    <div class="flex gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="text-yellow-400">{{ $i <= $evaluation->note ? '⭐' : '☆' }}</span>
                        @endfor
                    </div>
                </td>
                <td class="p-3 text-gray-600">{{ $evaluation->commentaire ?? '—' }}</td>
                <td class="p-3 text-gray-400">{{ $evaluation->date }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-3 text-center text-gray-500">
                    Aucune évaluation.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $evaluations->links() }}
    </div>
</div>

<a href="{{ route('manager.dashboard') }}"
   class="mt-4 inline-block text-blue-600 hover:underline">
    ← Retour au dashboard
</a>

@endsection