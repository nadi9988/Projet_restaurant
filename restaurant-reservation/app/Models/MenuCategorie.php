<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategorie extends Model
{
    // Exemple : propriétés à adapter selon ton modèle
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'ordre_affichage',
    ];

    // Relations exemple (à adapter)
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function plats()
    {
        return $this->hasMany(Plat::class);
    }

    /**
     * Scope pour filtrer selon les critères 'search' et 'restaurant_id'
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'like', "%{$search}%");
        }

        if (!empty($filters['restaurant_id'])) {
            $query->where('restaurant_id', $filters['restaurant_id']);
        }

        return $query;
    }
}
