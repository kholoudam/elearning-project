<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Inscription;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $categorie = $request->query('categorie');
            if ($categorie) {
                $cours = Cours::where('categorie', $categorie)->paginate(2);
            } else {
                $cours = Cours::paginate(3);
            }
            // Pour récupérer toutes les catégories distinctes (optionnel pour le menu)
            $categories = Cours::select('categorie')->distinct()->get();
            $user = auth()->user();
            $coursIds = Cours::where('enseignant_id', $user->id)->pluck('id');
            $mes_cours = $coursIds->count();
            $mes_etudiants = Inscription::whereIn('cours_id', $coursIds)->distinct('utilisateur_id')->count();
            return view('enseignants.index', compact('cours', 'categories', 'categorie', 'mes_cours', 'mes_etudiants'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
