<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
        'id_participant',
        'id_workshop',
        'date_inscription',
        'statut',
        'liste_attente'
    ];

    // Une inscription appartient à un participant
    public function participant()
    {
        return $this->belongsTo(User::class, 'id_participant');
    }

    // Une inscription appartient à un workshop
    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'id_workshop');
    }

    // Une inscription a un certificat
    public function certificat()
    {
        return $this->hasOne(Certificat::class, 'id_inscription');
    }

    // Une inscription a une évaluation
    public function evaluation()
    {
        return $this->hasOne(Evaluation::class, 'id_inscription');
    }
}