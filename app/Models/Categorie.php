<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'nom',
        'couleur'
    ];

    // Une catégorie a plusieurs workshops
    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'categorie_id');
    }
}