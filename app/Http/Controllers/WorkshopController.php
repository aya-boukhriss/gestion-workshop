<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $query = Workshop::with('formateur')
                    ->where('statut', 'ouvert');

        // Recherche par titre
        if ($request->search) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        // Filtre par lieu
        if ($request->lieu) {
            $query->where('lieu', 'like', '%' . $request->lieu . '%');
        }

        // Filtre par date
        if ($request->date) {
            $query->where('date_debut', $request->date);
        }

        $workshops = $query->latest()->paginate(9);

        return view('workshops.index', compact('workshops'));
    }

    public function show(Workshop $workshop)
    {
        $workshop->load('formateur', 'inscriptions');
        $dejaInscrit = false;
        if (Auth::check()) {
            $dejaInscrit = $workshop->inscriptions()
                ->where('id_participant', Auth::id())
                ->exists();
        }
        return view('workshops.show', compact('workshop', 'dejaInscrit'));
    }

    public function create()
    {
        return view('workshops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'       => 'required|string|max:200',
            'description' => 'required|string',
            'date_debut'  => 'required|date',
            'date_fin'    => 'required|date|after_or_equal:date_debut',
            'lieu'        => 'required|string|max:200',
            'capacite'    => 'required|integer|min:1',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('workshops', 'public');
        }

        Workshop::create([
            'titre'        => $request->titre,
            'description'  => $request->description,
            'date_debut'   => $request->date_debut,
            'date_fin'     => $request->date_fin,
            'lieu'         => $request->lieu,
            'capacite'     => $request->capacite,
            'statut'       => 'ouvert',
            'id_formateur' => Auth::id(),
            'photo'        => $photoPath,
        ]);

        return redirect()->route('workshops.index')
               ->with('success', 'Workshop créé avec succès !');
    }

    public function edit(Workshop $workshop)
    {
        return view('workshops.edit', compact('workshop'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $request->validate([
            'titre'       => 'required|string|max:200',
            'description' => 'required|string',
            'date_debut'  => 'required|date',
            'date_fin'    => 'required|date|after_or_equal:date_debut',
            'lieu'        => 'required|string|max:200',
            'capacite'    => 'required|integer|min:1',
            'statut'      => 'required|in:ouvert,complet,annule,termine',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = $workshop->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('workshops', 'public');
        }

        $workshop->update([
            'titre'       => $request->titre,
            'description' => $request->description,
            'date_debut'  => $request->date_debut,
            'date_fin'    => $request->date_fin,
            'lieu'        => $request->lieu,
            'capacite'    => $request->capacite,
            'statut'      => $request->statut,
            'photo'       => $photoPath,
        ]);

        // Générer les certificats si le workshop est terminé
        if ($request->statut === 'termine') {
            $inscriptions = $workshop->inscriptions()
                            ->where('statut', 'confirmee')
                            ->get();
            foreach ($inscriptions as $inscription) {
                CertificatController::generer($inscription);
            }
        }

        return redirect()->route('workshops.index')
               ->with('success', 'Workshop mis à jour !');
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('workshops.index')
               ->with('success', 'Workshop supprimé !');
    }
}