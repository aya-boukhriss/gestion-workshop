<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    protected $fillable = [
        'id_utilisateur',
        'specialites',
        'biographie',
        'note_moyenne',
        'photo'
    ];

    // Un formateur appartient à un utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    // Un formateur a plusieurs workshops
    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'id_formateur', 'id_utilisateur');
    }
}