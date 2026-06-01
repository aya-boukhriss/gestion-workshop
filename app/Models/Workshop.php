<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'lieu',
        'capacite',
        'statut',
        'id_formateur'
    ];

    // Un workshop appartient à un formateur
    public function formateur()
    {
        return $this->belongsTo(User::class, 'id_formateur');
    }

    // Un workshop a plusieurs inscriptions
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'id_workshop');
    }
}