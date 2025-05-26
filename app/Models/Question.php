<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'quiz_id', 'texte', 'option1', 'option2', 'option3', 'option4', 'bonne_reponse'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}