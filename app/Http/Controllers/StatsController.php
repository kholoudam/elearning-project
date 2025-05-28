<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Inscription;
use App\Models\Utilisateur;
use DB;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function adminStats()
    {
        $total_cours = Cours::count();
        $total_enseignants = Utilisateur::where('role', 'enseignant')->count();
        $total_etudiants   = Utilisateur::where('role', 'etudiant')->count();
        return view('admin.index', compact('total_cours', 'total_enseignants', 'total_etudiants'));
    }
    public function enseignantStats(Request $request)
    {
        $user = auth()->user();
        $coursIds = Cours::where('enseignant_id', $user->id)->pluck('id');
        $mes_cours = $coursIds->count();
        $mes_etudiants = Inscription::whereIn('cours_id', $coursIds)->distinct('utilisateur_id')->count();
        return view('enseignants.index', compact('mes_cours', 'mes_etudiants'));
    }
}
