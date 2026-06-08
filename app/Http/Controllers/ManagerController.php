<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use App\Models\Inscription;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    // Dashboard Manager
    public function index()
    {
        $stats = [
            'workshops'    => Workshop::count(),
            'inscriptions' => Inscription::count(),
            'formateurs'   => User::where('role', 'formateur')->count(),
            'participants' => User::where('role', 'participant')->count(),
        ];

        $workshops = Workshop::with('formateur', 'inscriptions')
                    ->latest()
                    ->paginate(10);

        return view('manager.dashboard', compact('stats', 'workshops'));
    }

    // Voir les évaluations
    public function evaluations()
    {
        $evaluations = Evaluation::with('inscription.workshop', 'inscription.participant')
                        ->latest()
                        ->paginate(10);

        return view('manager.evaluations', compact('evaluations'));
    }
}