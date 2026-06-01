@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-blue-800 mb-6">👥 Gestion des Utilisateurs</h1>

<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">Nom</th>
                <th class="text-left p-3">Email</th>
                <th class="text-left p-3">Rôle actuel</th>
                <th class="text-left p-3">Changer le rôle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td class="p-3">
                    <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex gap-2">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="border rounded px-2 py-1 text-sm">
                            <option value="participant" {{ $user->role == 'participant' ? 'selected' : '' }}>Participant</option>
                            <option value="formateur" {{ $user->role == 'formateur' ? 'selected' : '' }}>Formateur</option>
                            <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit" class="bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-700 text-xs">
                            Modifier
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

<a href="{{ route('admin.dashboard') }}" class="mt-4 inline-block text-blue-600 hover:underline">
    ← Retour au dashboard
</a>

@endsection