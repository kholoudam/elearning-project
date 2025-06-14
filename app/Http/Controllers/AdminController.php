<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cours;
use App\Models\Inscription;
use App\Models\Utilisateur;
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $categorie = $request->query('categorie');
        if ($categorie) {
            $cours = Cours::where('categorie', $categorie)->paginate(2);
        } else {
            $cours = Cours::paginate(3);
        }
        $categories = Cours::select('categorie')->distinct()->get();        
        $total_cours = Cours::count();
        $total_enseignants = Utilisateur::where('role', 'enseignant')->count();
        $total_etudiants = Utilisateur::where('role', 'etudiant')->count();
        $total_admin = Utilisateur::where('role', 'admin')->count();
        return view('admin.index', compact('total_cours', 'total_enseignants', 'total_etudiants','cours', 'categories', 'categorie','total_admin'));
    }
    public function AfficherCours(Request $request)
    {
        $categorie = $request->query('categorie');    
        if ($categorie) {
            $cours = Cours::where('categorie', $categorie)->paginate(2);
        } else {
            $cours = Cours::paginate(3);
        }
        $categories = Cours::select('categorie')->distinct()->get();
        return view('admin.AfficherCours', compact('cours', 'categories', 'categorie'));
    }
    public function show($id)
    {
        $cours = Cours::with('enseignant')->findOrFail($id);
        $coursList = Cours::all();
        return view('admin.show', compact('cours', 'coursList'));
    }
    public function filter(Request $request)
    {
        $categorie = $request->input('categorie');
        $cours = Cours::where('categorie', $categorie)->paginate(2);
        return view('coursa.index', compact('cours'));
    }
    public function create()
    {
        $enseignants = Utilisateur::where('role', 'enseignant')->get();
        return view('admin.ajouterCours', compact('enseignants'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'difficulte' => 'required|string',
            'categorie' => 'required|string',
            'enseignant_id' => [
                'required',
                'exists:utilisateurs,id',
                function ($attribute, $value, $fail) {
                    $user = \App\Models\Utilisateur::find($value);
                    if (!$user || $user->role !== 'enseignant') {
                        $fail("L'utilisateur sélectionné n'est pas un enseignant.");
                    }
                },
            ],
        ]);
        Cours::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'difficulte' => $request->difficulte,
            'categorie' => $request->categorie,
            'enseignant_id' => $request->enseignant_id,
        ]);
        return redirect()->route('admin.index')->with('success', 'Cours ajouté avec succès.');
    }
    public function edit($id)
    {
        $cours = Cours::findOrFail($id);
        $coursList = Cours::all();
        return view('admin.editCours', compact('cours', 'coursList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulte' => 'required|string',
            'categorie' => 'nullable|string',
        ]);
        $cours = Cours::findOrFail($id);
        $cours->update($request->all());
        return redirect()->route('cours.index')->with('success', 'Cours mis à jour avec succès.');
    }
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();

        return redirect()->route('cours.index')->with('success', 'Cours supprimé avec succès.');
    }
}
