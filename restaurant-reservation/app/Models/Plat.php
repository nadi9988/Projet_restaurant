<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function menuCategorie()
    {
        return $this->belongsTo(MenuCategorie::class);
    }

    public function ligneCommandes()
    {
        return $this->hasMany(LigneCommande::class);
    }
    // Method Soon . . . 
}
