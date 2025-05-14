<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plat extends Model
{
    protected $fillable = [
        'menu_categorie_id',
        'nom',
        'description',
        'price',
        'image',
        'available',
    ];

    protected $casts = [
        'price' => 'float',
        'available' => 'boolean',
    ];

    // Relations
    public function menuCategorie()
    {
        return $this->belongsTo(MenuCategorie::class);
    }

    public function ligneCommandes()
    {
        return $this->hasMany(LigneCommande::class);
    }

    // Accesseurs (Getters)
    public function getNomAttribute($value)
    {
        return Str::title($value);
    }

    public function getDescriptionAttribute($value)
    {
        return Str::ucfirst($value);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2, ',', ' ') . ' €';
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/images/plats/' . $value) : null;
    }

    public function getAvailableAttribute($value)
    {
        return $value ? 'Disponible' : 'Non disponible';
    }

    // Mutateurs (Setters)
    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = trim(Str::lower($value));
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(Str::ucfirst($value));
    }

    public function setPriceAttribute($value)
    {
        // Nettoyer la valeur numérique
        $cleanValue = (float)preg_replace('/[^0-9,.]/', '', str_replace(',', '.', $value));
        $this->attributes['price'] = round($cleanValue, 2);
    }

    // Méthode supplémentaire pour vérifier la disponibilité
    public function isAvailable()
    {
        return $this->available;
    }

    // Méthode pour formater le prix sans le symbole
    public function getRawPrice()
    {
        return number_format($this->price, 2, '.', '');
    }
}