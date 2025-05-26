<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $table = 'cours';

    protected $fillable = [
        'titre', 'description', 'categorie', 'difficulte', 'enseignant_id'
    ];

    public function enseignant()
    {
        return $this->belongsTo(Utilisateur::class, 'enseignant_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function certificats()
    {
        return $this->hasMany(Certificat::class);
    }

    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }
}