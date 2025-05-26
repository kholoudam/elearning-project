<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom', 'email', 'mot_de_passe', 'role'
    ];
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    protected $hidden = ['mot_de_passe'];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function coursEnseignes()
    {
        return $this->hasMany(Cours::class, 'enseignant_id');
    }

    public function certificats()
    {
        return $this->hasMany(Certificat::class);
    }

    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

    public function quizEtudiants()
    {
        return $this->hasMany(QuizEtudiant::class);
    }
}