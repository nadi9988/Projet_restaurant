<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Restaurant extends Model
{
    protected $fillable = [
    'nom',
    'adresse',
    'telephone',
    'email',
    'description',
    'image',
    'is_active',
    ];

    // Relations
    public function horaire()
    {
        return $this->hasOne(Horaire::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function menuCategories()
    {
        return $this->hasMany(MenuCategorie::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Scopes de recherche
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeWithTablesAvailable(Builder $query): Builder
    {
        return $query->whereHas('tables', function($q) {
            $q->available();
        });
    }

    public function scopeHasMenuCategories(Builder $query): Builder
    {
        return $query->whereHas('menuCategories');
    }

    public function scopeInLocation(Builder $query, string $location): Builder
    {
        return $query->where('adresse', 'like', "%$location%");
    }

    // Capacité
    public function canAccommodateGroup(int $people): bool
    {
        return $this->tables()->sum('capacity') >= $people;
    }

    public function totalCapacity(): int
    {
        return $this->tables()->sum('capacity');
    }

    // Gestion des réservations
    public function nextAvailableTime(int $people): ?Carbon
    {
        return $this->tables()
            ->available()
            ->withCapacity($people)
            ->orderBy('capacity')
            ->first()
            ?->nextAvailableSlot();
    }

    public function hasReservationsOn(Carbon $date): bool
    {
        return $this->reservations()
            ->whereDate('date_time', $date)
            ->exists();
    }

    // Horaires
    public function isOpenNow(): bool
    {
        if (!$this->horaire) return false;
        
        return $this->horaire->isOpenAt(now());
    }

    public function nextOpeningTime(): ?Carbon
    {
        return $this->horaire?->nextOpeningTime();
    }

    public function exceptions(): Collection
    {
        return $this->horaire?->exceptional_days ?? collect();
    }

    // Statistiques
    public function averageRating(): float
    {
        return $this->reservations()
            ->avg('rating') ?? 0;
    }

    public function totalReservationsCount(): int
    {
        return $this->reservations()->count();
    }

    public function upcomingReservations()
    {
        return $this->reservations()
            ->where('date_time', '>', now())
            ->orderBy('date_time')
            ->get();
    }

    // Formatage des données
    public function getFormattedPhoneAttribute(): string
    {
        return preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})/', '$1 $2 $3 $4', $this->telephone);
    }

    public function getGoogleMapsLinkAttribute(): string
    {
        return 'https://www.google.com/maps/search/?api=1&query=' . urlencode($this->adresse);
    }

    // Menu
    public function hasMenuItems(): bool
    {
        return $this->menuCategories()
            ->whereHas('plats')
            ->exists();
    }

    public function mainMenuCategory(): ?MenuCategorie
    {
        return $this->menuCategories()
            ->orderBy('order')
            ->first();
    }

    // État
    public function activate(): void
    {
        $this->update(['is_active' => true]);
    }

    public function deactivate(): void
    {
        $this->update(['is_active' => false]);
    }

    // Validation
    public function hasSufficientCapacity(Carbon $dateTime, int $people): bool
    {
        return $this->tables()
            ->available()
            ->withCapacity($people)
            ->whereDoesntHave('reservations', function($q) use ($dateTime) {
                $q->conflictingWith($dateTime);
            })
            ->exists();
    }

    // Relations dédiées
    public function availableTables()
    {
        return $this->tables()->available();
    }
}