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
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    // Relations
    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }

    // Accesseurs (Getters)
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

    // Mutateurs (Setters)
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

    // Méthodes utilitaires
    public function isAvailable()
    {
        return $this->is_available;
    }

    public function livraisonsCount()
    {
        return $this->livraisons()->count();
    }

    public function isBusy()
    {
        return $this->livraisons()->where('status', '!=', 'livrée')->exists();
    }

    public function getLatestLivraison()
    {
        return $this->livraisons()->latest()->first();
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeBusy($query)
    {
        return $query->where('is_available', false);
    }

    // Formatage spécial pour les numéros marocains
    public function getFormattedPhoneNumber()
    {
        return preg_replace('/(\d{2})(\d{3})(\d{4})/', '+212 \1-\2-\3', $this->phoneNumber);
    }
}