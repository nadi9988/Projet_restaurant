<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Livreur extends Model
{
    protected $fillable = [
        'lastName',
        'firstName',
        'phoneNumber',
        'is_available',
        'etat',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('etat', 'actif');
    }

    public function scopeDisponible($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeOccupe($query)
    {
        return $query->where('is_available', false);
    }

    // Relations
    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return Str::title($this->firstName . ' ' . $this->lastName);
    }

    public function getPhoneNumberAttribute($value)
    {
        return '+212 ' . substr($value, 0, 2) . '-' . substr($value, 2, 3) . '-' . substr($value, 5);
    }

    public function getAvailabilityStatusAttribute()
    {
        return $this->is_available ? 'Disponible' : 'Occupé';
    }

    // Mutators
    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstName'] = trim(Str::title($value));
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['lastName'] = trim(Str::upper($value));
    }

    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phoneNumber'] = preg_replace('/[^0-9]/', '', $value);
    }

    // Utility methods
    public function estDisponible(): bool
    {
        return (bool) $this->is_available;
    }

    public function estOccupe(): bool
    {
        return !$this->is_available;
    }

    public function livraisonsCount(): int
    {
        return $this->livraisons()->count();
    }

    public function aLivraisonsEnCours(): bool
    {
        return $this->livraisons()->where('status', '!=', 'livrée')->exists();
    }

    public function getLatestLivraison()
    {
        return $this->livraisons()->latest()->first();
    }
}
