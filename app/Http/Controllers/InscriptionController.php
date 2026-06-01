<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    // S'inscrire à un workshop
    public function store(Request $request, Workshop $workshop)
    {
        // Vérifier si déjà inscrit
        $dejaInscrit = Inscription::where('id_participant', Auth::id())
                        ->where('id_workshop', $workshop->id)
                        ->exists();

        if ($dejaInscrit) {
            return back()->with('error', 'Vous êtes déjà inscrit à ce workshop !');
        }

        // Vérifier la capacité
        $nbInscrits = Inscription::where('id_workshop', $workshop->id)
                        ->where('statut', 'confirmee')
                        ->count();

        $listeAttente = $nbInscrits >= $workshop->capacite;

        Inscription::create([
            'id_participant' => Auth::id(),
            'id_workshop'    => $workshop->id,
            'statut'         => $listeAttente ? 'liste_attente' : 'confirmee',
            'liste_attente'  => $listeAttente,
        ]);

        $message = $listeAttente
            ? 'Vous avez été ajouté à la liste d\'attente.'
            : 'Inscription confirmée avec succès !';

        return back()->with('success', $message);
    }

    // Annuler une inscription
    public function destroy(Inscription $inscription)
    {
        $inscription->delete();
        return back()->with('success', 'Inscription annulée !');
    }

    // Espace participant
    public function monEspace()
    {
        $inscriptions = Inscription::with('workshop', 'certificat')
                        ->where('id_participant', Auth::id())
                        ->latest()
                        ->get();

        return view('participant.mon_espace', compact('inscriptions'));
    }
}