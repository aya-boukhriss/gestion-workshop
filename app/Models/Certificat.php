<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    protected $fillable = [
        'id_inscription',
        'numero_unique',
        'date_emission',
        'chemin_pdf'
    ];

    // Un certificat appartient à une inscription
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'id_inscription');
    }
}