<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCategorie extends Model
{
    protected $fillable = [
        'restaurant_id',
        'nom',
        'description',
        'ordre_affichage',
    ];

    /**
     * Une catégorie a plusieurs plats.
     *
     * @return HasMany
     */
    public function plats(): HasMany
    {
        return $this->hasMany(Plat::class, 'menu_categories_id');
    }

    /**
     * Une catégorie appartient à un restaurant.
     *
     * @return BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Scope de filtrage par nom et restaurant.
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when(!empty($filters['search']), function ($q) use ($filters) {
                $q->where('nom', 'like', '%' . $filters['search'] . '%');
            })
            ->when(!empty($filters['restaurant_id']), function ($q) use ($filters) {
                $q->where('restaurant_id', $filters['restaurant_id']);
            });
    }
}
