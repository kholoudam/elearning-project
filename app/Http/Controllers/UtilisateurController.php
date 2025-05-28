<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::paginate(10);
        return view('admin.AfficherUser', compact('utilisateurs'));
    }
    public function create()
    {
        return view('admin.AjouterUser');
    }
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
    public function show($id)
    {
        $utilisateurs = Utilisateur::findOrFail($id);
        $utilisateursList = Utilisateur::all();
        return view('admin.ShowUser', compact('utilisateurs','utilisateursList'));
    }
    public function edit($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateurs = Utilisateur::all();
        return view('admin.ModifierUser', compact('utilisateur', 'utilisateurs'));
    }
    public function update(Request $request, $id)
    {
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
        $utilisateur->update($data);
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès');
    }
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}