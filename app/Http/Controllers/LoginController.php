<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class LoginController extends Controller
{
    /**
     * Affiche la vue de connexion.
     */
    public function show()
    {
        return view('login'); // Assure-toi que cette vue existe
    }

    /**
     * Gère la connexion de l'utilisateur.
     */
    public function register(Request $request)
{
    // 1. Valider les champs du formulaire
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:utilisateurs,email',
        'mot_de_passe' => 'required|string|min:6|confirmed',
    ]);

    // 2. Créer l'utilisateur
    $utilisateur = new Utilisateur();
    $utilisateur->nom = $request->nom;
    $utilisateur->email = $request->email;
    $utilisateur->mot_de_passe = Hash::make($request->mot_de_passe);
    $utilisateur->role = 'etudiant'; // ou autre valeur par défaut
    $utilisateur->save();

    // 3. Rediriger avec un message
    return redirect()->route('login.show')->with('success', 'Inscription réussie ! Vous pouvez vous connecter.');
}
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        // Récupérer l'utilisateur avec l'email donné
        $user = Utilisateur::where('email', $request->email)->first();

        // Vérifier si l'utilisateur existe et que le mot de passe est correct
        if ($user && Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
            Auth::login($user);
            $request->session()->regenerate();

            // Redirection en fonction du rôle
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.index')->with('success', 'Bienvenue admin !');
                case 'enseignant':
                    return redirect()->route('enseignants.index')->with('success', 'Bienvenue enseignant !');
                case 'etudiant':
                    return redirect()->route('index')->with('success', 'Bienvenue étudiant !');
                default:
                    return redirect()->route('index')->with('success', 'Bienvenue !');
            }
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    // public function Profile()
    // {
    //     $user = Auth::user();
    //     return view('profile_show', compact('user'));
    // }
    // public function Profile()
    // {
    //     $user = Auth::user();

    //     // Si l'utilisateur est admin ou enseignant, on récupère la liste des enseignants
    //     if (in_array($user->role, ['admin', 'enseignant'])) {
    //         $enseignants = Utilisateur::where('role', 'enseignant')->get();
    //         return view('profile_show', compact('user', 'enseignants'));
    //     }

    //     // Sinon, on retourne seulement l'utilisateur (étudiant par exemple)
    //     return view('profile_show', compact('user'));
    // }
    public function Profile()
{
    $user = Auth::user();

    if ($user->role === 'admin') {
        $enseignants = Utilisateur::where('role', 'enseignant')->get();
        return view('profile_show', compact('user', 'enseignants'));
    }

    if ($user->role === 'enseignant') {
        $cours = \App\Models\Cours::where('enseignant_id', $user->id)->get();
        return view('profile_show', compact('user', 'cours'));
    }

    if ($user->role === 'etudiant') {
        $certificats = \App\Models\Certificat::with('cours')->where('utilisateur_id', $user->id)->get();
        return view('profile_show', compact('user', 'certificats'));
    }

    return view('profile_show', compact('user'));
}

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $user->id,
            'mot_de_passe' => 'nullable|confirmed|min:8',
        ]);

        $user->nom = $request->nom;
        $user->email = $request->email;

        if ($request->filled('mot_de_passe')) {
            $user->mot_de_passe = Hash::make($request->mot_de_passe);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
}