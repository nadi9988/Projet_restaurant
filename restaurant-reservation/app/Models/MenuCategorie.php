<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuCategorie extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
    ];

    // Relations
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function plats()
    {
        return $this->hasMany(Plat::class);
    }

    // Accesseurs (Getters)
    public function getNameAttribute($value)
    {
        return Str::title($value);
    }

    public function getDescriptionAttribute($value)
    {
        return Str::ucfirst($value);
    }

    // Mutateurs (Setters)
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(Str::lower($value));
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(Str::ucfirst($value));
    }

    // Méthodes utilitaires
    public function platsCount()
    {
        return $this->plats()->count();
    }

    public function hasPlats()
    {
        return $this->platsCount() > 0;
    }

    public function getTruncatedDescription($length = 100)
    {
        return Str::limit($this->description, $length, '...');
    }

    public function getRestaurantName()
    {
        return $this->restaurant->name ?? 'Aucun restaurant associé';
    }

    // Méthode de statut
    public function isActive()
    {
        return $this->plats()->where('available', true)->exists();
    }

    // Méthode de recherche
    public function scopeWithPlats($query)
    {
        return $query->with(['plats' => function($q) {
            $q->where('available', true);
        }]);
    }
}