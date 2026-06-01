<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Vérifier si l'utilisateur est admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Vérifier si l'utilisateur est formateur
    public function isFormateur()
    {
        return $this->role === 'formateur';
    }

    // Vérifier si l'utilisateur est manager
    public function isManager()
    {
        return $this->role === 'manager';
    }

    // Un user a plusieurs inscriptions
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'id_participant');
    }

    // Un user formateur a plusieurs workshops
    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'id_formateur');
    }

    // Un user formateur a un profil formateur
    public function formateur()
    {
        return $this->hasOne(Formateur::class, 'id_utilisateur');
    }
}