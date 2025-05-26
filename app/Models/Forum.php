<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forum';

    protected $fillable = [
        'commentaire', 'utilisateur_id', 'cours_id'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}