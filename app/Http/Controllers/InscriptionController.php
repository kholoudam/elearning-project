<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    public function inscrire($id)
    {
        $user = Auth::user();
        if ($user->role !== 'etudiant') {
            return back()->with('error', 'Seuls les étudiants peuvent s’inscrire.');
        }

        if ($user->inscriptions()->where('cours_id', $id)->exists()) {
            return back()->with('info', 'Vous êtes déjà inscrit à ce cours.');
        }
        Inscription::create([
            'utilisateur_id' => $user->id,
            'cours_id'       => $id,
            'etat'           => 'en cours',
        ]);
        return back()->with('success', 'Inscription réussie !');
    }
}