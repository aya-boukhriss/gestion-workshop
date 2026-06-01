<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurController extends Controller
{
    // Dashboard formateur
    public function dashboard()
    {
        $workshops = Workshop::where('id_formateur', Auth::id())
                    ->latest()
                    ->take(5)
                    ->get();

        $totalInscrits = Inscription::whereHas('workshop', function($q) {
            $q->where('id_formateur', Auth::id());
        })->count();

        return view('formateur.dashboard', compact('workshops', 'totalInscrits'));
    }

    // Mes workshops
    public function mesWorkshops()
    {
        $workshops = Workshop::where('id_formateur', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('formateur.workshops', compact('workshops'));
    }

    // Participants d'un workshop
    public function participants(Workshop $workshop)
    {
        $inscriptions = Inscription::with('participant')
                        ->where('id_workshop', $workshop->id)
                        ->get();

        return view('formateur.participants', compact('workshop', 'inscriptions'));
    }
}