<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizEtudiant extends Model
{
    protected $table = 'quiz_etudiant';

    protected $fillable = [
        'quiz_id', 'utilisateur_id', 'note'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}