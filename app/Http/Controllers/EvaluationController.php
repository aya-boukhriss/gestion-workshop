<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    // Soumettre une évaluation
    public function store(Request $request, Inscription $inscription)
    {
        $request->validate([
            'note'        => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:500',
        ]);

        // Vérifier que l'inscription appartient à l'utilisateur connecté
        if ($inscription->id_participant !== Auth::id()) {
            abort(403);
        }

        // Vérifier si déjà évalué
        $dejaEvalue = Evaluation::where('id_inscription', $inscription->id)->exists();
        if ($dejaEvalue) {
            return back()->with('error', 'Vous avez déjà évalué ce workshop !');
        }

        Evaluation::create([
            'id_inscription' => $inscription->id,
            'note'           => $request->note,
            'commentaire'    => $request->commentaire,
            'date'           => now()->toDateString(),
        ]);

        return back()->with('success', 'Évaluation soumise avec succès !');
    }
}