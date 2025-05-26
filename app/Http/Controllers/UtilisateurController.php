<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Affiche une liste des utilisateurs (Vue : admin.AfficherUser).
     */
    public function index()
    {
        $utilisateurs = Utilisateur::paginate(10);
        return view('admin.AfficherUser', compact('utilisateurs'));
    }

    /**
     * Affiche le formulaire de création d'un utilisateur (optionnel si tu ne veux pas que l'admin crée un utilisateur manuellement).
     */
    public function create()
    {
        return view('admin.AjouterUser'); // Si tu comptes l'utiliser
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'mot_de_passe' => 'required|string|min:6',
            'role' => 'required|in:admin,enseignant,etudiant',
        ]);

        Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'mot_de_passe' => bcrypt($request->mot_de_passe),
            'role' => $request->role,
        ]);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un utilisateur (Vue : admin.ShowUser).
     */
    public function show($id)
    {
        $utilisateurs = Utilisateur::findOrFail($id);
        $utilisateursList = Utilisateur::all();
        return view('admin.ShowUser', compact('utilisateurs','utilisateursList'));
    }

    /**
     * Affiche le formulaire d'édition (Vue : admin.ModifierUser).
     */
    public function edit($id)
    {
        $utilisateur = Utilisateur::findOrFail($id); // un seul utilisateur

        // Récupérer la liste complète pour la sidebar
        $utilisateurs = Utilisateur::all();

        return view('admin.ModifierUser', compact('utilisateur', 'utilisateurs'));
    }

    /**
     * Met à jour un utilisateur existant.
     */
public function update(Request $request, $id)
{
    // First find the user you're updating
    $utilisateur = Utilisateur::findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email|unique:utilisateurs,email,' . $utilisateur->id,
        'mot_de_passe' => 'nullable|string|min:6',
        'role' => 'required|in:admin,enseignant,etudiant',
    ]);

    $data = $request->only('nom', 'email', 'role');

    if ($request->filled('mot_de_passe')) {
        $data['mot_de_passe'] = bcrypt($request->mot_de_passe);
    }

    // Update the found user
    $utilisateur->update($data);

    // Don't forget to return a response
    return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès');
}

    /**
     * Supprime un utilisateur.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}