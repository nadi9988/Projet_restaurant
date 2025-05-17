<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Table extends Model
{
    protected $fillable = [
        'restaurant_id',
        'numero',
        'capacity',
        'available',
        'location',
        'description',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    // Relations

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Scopes

    /**
     * Filtrage dynamique selon critères
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if (!empty($filters['restaurant_id'])) {
            $query->where('restaurant_id', $filters['restaurant_id']);
        }

        if (!empty($filters['capacity'])) {
            $query->where('capacity', '>=', $filters['capacity']);
        }

        if (isset($filters['available'])) {
            $available = filter_var($filters['available'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if (!is_null($available)) {
                $query->where('available', $available);
            }
        }

        if (!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        return $query;
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('available', true);
    }

    public function scopeWithCapacity(Builder $query, int $minCapacity): Builder
    {
        return $query->where('capacity', '>=', $minCapacity);
    }

    public function scopeInLocation(Builder $query, string $location): Builder
    {
        return $query->where('location', 'like', "%$location%");
    }

    // Méthodes métiers

    /**
     * Vérifie si la table est disponible entre deux horaires
     */
    public function isAvailableAt(Carbon $startTime, Carbon $endTime): bool
    {
        return !$this->reservations()
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('date_time', [$startTime, $endTime])
                      ->orWhere(function ($q) use ($startTime, $endTime) {
                          $q->where('date_time', '<', $startTime)
                            ->where('end_time', '>', $endTime);
                      });
            })
            ->exists();
    }

    /**
     * Vérifie si la table peut accueillir le nombre de personnes
     */
    public function canAccommodate(int $people): bool
    {
        return $this->capacity >= $people;
    }

    /**
     * Met la table disponible
     */
    public function markAsAvailable(): void
    {
        $this->update(['available' => true]);
    }

    /**
     * Met la table indisponible
     */
    public function markAsUnavailable(): void
    {
        $this->update(['available' => false]);
    }

    // Accessors

    /**
     * Retourne un nom complet pour la table, ex : "NomRestaurant - Table 1"
     */
    public function getFullTableNameAttribute(): string
    {
        $restaurantName = $this->restaurant ? $this->restaurant->name : 'Unknown';
        return $restaurantName . ' - Table ' . $this->numero;
    }

    /**
     * Capitalise la première lettre de location
     */
    public function getLocationAttribute(string $value): string
    {
        return ucfirst(strtolower($value));
    }

    // Statistiques et réservations

    public function reservationCount(): int
    {
        return $this->reservations()->count();
    }

    public function upcomingReservations()
    {
        return $this->reservations()
            ->where('date_time', '>', now())
            ->orderBy('date_time');
    }

    public function pastReservations()
    {
        return $this->reservations()
            ->where('date_time', '<', now())
            ->orderByDesc('date_time');
    }

    // Vérifie si la table est dans une zone donnée
    public function isInArea(string $area): bool
    {
        return strtolower($this->location) === strtolower($area);
    }
}
