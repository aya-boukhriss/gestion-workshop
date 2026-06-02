<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $query = Workshop::with('formateur', 'categorie')
                    ->where('statut', 'ouvert');

        if ($request->search) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        if ($request->lieu) {
            $query->where('lieu', 'like', '%' . $request->lieu . '%');
        }

        if ($request->date) {
            $query->where('date_debut', $request->date);
        }

        if ($request->categorie) {
            $query->where('categorie_id', $request->categorie);
        }

        $workshops = $query->latest()->paginate(9);
        $categories = Categorie::all();

        return view('workshops.index', compact('workshops', 'categories'));
    }

    public function show(Workshop $workshop)
    {
        $workshop->load('formateur', 'inscriptions.evaluation', 'categorie');
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
        $categories = Categorie::all();
        return view('workshops.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'        => 'required|string|max:200',
            'description'  => 'required|string',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after_or_equal:date_debut',
            'lieu'         => 'required|string|max:200',
            'capacite'     => 'required|integer|min:1',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categorie_id' => 'nullable|exists:categories,id',
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
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('workshops.index')
               ->with('success', 'Workshop créé avec succès !');
    }

    public function edit(Workshop $workshop)
    {
        $categories = Categorie::all();
        return view('workshops.edit', compact('workshop', 'categories'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $request->validate([
            'titre'        => 'required|string|max:200',
            'description'  => 'required|string',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after_or_equal:date_debut',
            'lieu'         => 'required|string|max:200',
            'capacite'     => 'required|integer|min:1',
            'statut'       => 'required|in:ouvert,complet,annule,termine',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        $photoPath = $workshop->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('workshops', 'public');
        }

        $workshop->update([
            'titre'        => $request->titre,
            'description'  => $request->description,
            'date_debut'   => $request->date_debut,
            'date_fin'     => $request->date_fin,
            'lieu'         => $request->lieu,
            'capacite'     => $request->capacite,
            'statut'       => $request->statut,
            'photo'        => $photoPath,
            'categorie_id' => $request->categorie_id,
        ]);

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