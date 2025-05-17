<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Admin;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'lastName',
        'firstName',
        'email',
        'password',
        'telephone',
        'InscriptionDate',
        'isActive',
        'type',
        'rememberToken'
    ];
    
    protected $hidden = [
        'password',
        'rememberToken'
    ];
    
    protected $casts = [
        'InscriptionDate' => 'datetime',
        'isActive' => 'boolean'
    ];

    // Relations
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    // Vérification des rôles
    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    public function isClient(): bool
    {
        return $this->type === 'client';
    }

    // Gestion de l'activation
    public function activate(): void
    {
        $this->update(['isActive' => true]);
    }

    public function deactivate(): void
    {
        $this->update(['isActive' => false]);
    }

    // Mutateur pour le mot de passe
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Gestion des jetons de réinitialisation
    public function createPasswordResetToken(): string
    {
        $token = Str::random(60);
        $this->forceFill([
            'rememberToken' => Hash::make($token)
        ])->save();

        return $token;
    }

    // Accesseurs
    public function getFullNameAttribute(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getFormattedInscriptionDateAttribute(): string
    {
        return $this->InscriptionDate->format('d/m/Y H:i');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }

    public function scopeAdmins($query)
    {
        return $query->where('type', 'admin');
    }

    public function scopeClients($query)
    {
        return $query->where('type', 'client');
    }

    // Récupération du compte lié
    public function getLinkedAccount()
    {
        return $this->isAdmin() ? $this->admin : $this->client;
    }

    // Vérification de l'état
    public function isActiveAccount(): bool
    {
        return $this->isActive;
    }

    // Vérification de la date d'inscription
    public function isRecentlyRegistered(int $days = 7): bool
    {
        return $this->InscriptionDate->diffInDays(Carbon::now()) <= $days;
    }

    // Génération d'avatar
    public function getAvatarUrl(int $size = 80): string
    {
        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=identicon";
    }
}
/*
    one-to-one   === 1-1 === hasOne
    One to Many  === 1-* === hasMany
    Many to Many === *-* === belongsToMany
*/