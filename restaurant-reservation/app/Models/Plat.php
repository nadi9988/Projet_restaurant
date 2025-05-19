<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plat extends Model
{
    // Champs modifiables en masse
    protected $fillable = [
        'nom',
        'menu_categories_id',
        'prix',          
        'disponible',    
        'description',
        'image',
    ];

    // Casts pour conversion automatique
    protected $casts = [
        'prix' => 'float',
        'disponible' => 'boolean',
    ];

    // Relation vers la catégorie du menu
    public function menuCategorie()
    {
        return $this->belongsTo(MenuCategorie::class, 'menu_categories_id');
    }



    public function getNomAttribute($value)
    {
        return Str::title($value);
    }

    public function getDescriptionAttribute($value)
    {
        return Str::ucfirst($value);
    }

    public function getPrixAttribute($value)
    {
        return number_format($value, 2, ',', ' ') . ' MAD';
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/images/plats/' . $value) : null;
    }

    public function getDisponibleAttribute($value)
    {
        return $value ? 'Disponible' : 'Non disponible';
    }

    // Mutateurs (setters) pour nettoyer les données avant insertion

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = trim(Str::lower($value));
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(Str::ucfirst($value));
    }

    public function setPrixAttribute($value)
    {
        // Nettoyer la valeur numérique en format float
        $cleanValue = (float)preg_replace('/[^0-9,.]/', '', str_replace(',', '.', $value));
        $this->attributes['prix'] = round($cleanValue, 2);
    }

    // Méthode pour savoir si le plat est disponible (booléen)
    public function isDisponible()
    {
        return $this->disponible;
    }

    // Méthode pour obtenir le prix brut sans formatage (ex: pour calculs)
    public function getRawPrix()
    {
        return number_format($this->attributes['prix'], 2, '.', '');
    }
}
