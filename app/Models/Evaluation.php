<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'id_inscription',
        'note',
        'commentaire',
        'date'
    ];

    // Une évaluation appartient à une inscription
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'id_inscription');
    }
}