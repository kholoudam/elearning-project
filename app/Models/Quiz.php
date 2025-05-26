<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';

    protected $fillable = [
        'titre', 'cours_id'
    ];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function quizEtudiants()
    {
        return $this->hasMany(QuizEtudiant::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}