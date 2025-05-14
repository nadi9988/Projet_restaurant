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

    // Vérifications
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

    public function canAccommodate(int $people): bool
    {
        return $this->capacity >= $people;
    }

    // Gestion de la disponibilité
    public function markAsAvailable(): void
    {
        $this->update(['available' => true]);
    }

    public function markAsUnavailable(): void
    {
        $this->update(['available' => false]);
    }

    // Formattage des données
    public function getFullTableNameAttribute(): string
    {
        return $this->restaurant->nom . ' - Table ' . $this->numero;
    }

    public function getLocationAttribute($value): string
    {
        return ucfirst(strtolower($value));
    }

    // Statistiques
    public function reservationCount(): int
    {
        return $this->reservations()->count();
    }

    public function upcomingReservations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->reservations()
            ->where('date_time', '>', now())
            ->orderBy('date_time');
    }

    public function pastReservations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->reservations()
            ->where('date_time', '<', now())
            ->orderByDesc('date_time');
    }

    // Vérification de zone
    public function isInArea(string $area): bool
    {
        return strtolower($this->location) === strtolower($area);
    }
}