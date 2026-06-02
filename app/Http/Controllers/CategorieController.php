<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Liste des catégories
    public function index()
    {
        $categories = Categorie::withCount('workshops')->get();
        return view('admin.categories', compact('categories'));
    }

    // Créer une catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom'     => 'required|string|max:100',
            'couleur' => 'required|string',
        ]);

        Categorie::create([
            'nom'     => $request->nom,
            'couleur' => $request->couleur,
        ]);

        return back()->with('success', 'Catégorie créée avec succès !');
    }

    // Supprimer une catégorie
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return back()->with('success', 'Catégorie supprimée !');
    }
}