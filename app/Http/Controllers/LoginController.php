<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class LoginController extends Controller
{
    public function show()
    {
        return view('login'); 
    }
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs,email',
            'mot_de_passe' => 'required|string|min:6|confirmed',
        ]);
        $utilisateur = new Utilisateur();
        $utilisateur->nom = $request->nom;
        $utilisateur->email = $request->email;
        $utilisateur->mot_de_passe = Hash::make($request->mot_de_passe);
        $utilisateur->role = 'etudiant';
        $utilisateur->save();
        return redirect()->route('login.show')->with('success', 'Inscription réussie ! Vous pouvez vous connecter.');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);
        $user = Utilisateur::where('email', $request->email)->first();
        if ($user && Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
            Auth::login($user);
            $request->session()->regenerate();
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
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
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