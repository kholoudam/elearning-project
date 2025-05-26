<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    protected $table = 'certificats';

    protected $fillable = [
        'utilisateur_id', 'cours_id', 'date_obtention', 'image_path'
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