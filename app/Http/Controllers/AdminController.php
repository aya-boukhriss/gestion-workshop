<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use App\Models\Inscription;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard admin
    public function index()
    {
        $stats = [
            'users'       => User::count(),
            'workshops'   => Workshop::count(),
            'inscriptions'=> Inscription::count(),
            'formateurs'  => User::where('role', 'formateur')->count(),
        ];

        $recentWorkshops = Workshop::with('formateur')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact('stats', 'recentWorkshops'));
    }

    // Liste des utilisateurs
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    // Modifier le rôle d'un utilisateur
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,manager,formateur,participant'
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Rôle mis à jour !');
    }
}