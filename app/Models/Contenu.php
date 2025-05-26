<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    use HasFactory;

    
    protected $table = 'contenus';

   
    protected $fillable = [
        'cours_id',
        'titre',
        'description',
        'type',
        'lien',
    ];

    // Définir la relation entre Contenu et Cours
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'cours_id');
    }
}
