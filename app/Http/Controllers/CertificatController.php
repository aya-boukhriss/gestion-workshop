<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificatController extends Controller
{
    // Télécharger un certificat
    public function download(Certificat $certificat)
    {
        $inscription = Inscription::with('workshop', 'participant')
                        ->find($certificat->id_inscription);

        if ($inscription->id_participant !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $pdf = Pdf::loadView('pdf.certificat', [
            'participant' => $inscription->participant->name,
            'workshop'    => $inscription->workshop->titre,
            'date_debut'  => $inscription->workshop->date_debut,
            'date_fin'    => $inscription->workshop->date_fin,
            'lieu'        => $inscription->workshop->lieu,
            'formateur'   => $inscription->workshop->formateur->name ?? 'N/A',
            'numero'      => $certificat->numero_unique,
        ]);

        return $pdf->download('certificat-' . $certificat->numero_unique . '.pdf');
    }

    // Générer un certificat
    public static function generer(Inscription $inscription)
    {
        $existant = Certificat::where('id_inscription', $inscription->id)->first();
        if ($existant) return $existant;

        $numeroUnique = strtoupper(Str::random(10));

        $certificat = Certificat::create([
            'id_inscription' => $inscription->id,
            'numero_unique'  => $numeroUnique,
            'date_emission'  => now()->toDateString(),
            'chemin_pdf'     => null,
        ]);

        return $certificat;
    }
}