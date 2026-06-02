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
        'role',
        'photo',
        'telephone',
        'bio'
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

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isFormateur()
    {
        return $this->role === 'formateur';
    }

    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'id_participant');
    }

    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'id_formateur');
    }

    public function formateur()
    {
        return $this->hasOne(Formateur::class, 'id_utilisateur');
    }
}