<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'inscriptions';

    protected $fillable = [
        'utilisateur_id', 'cours_id', 'date_inscription'
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