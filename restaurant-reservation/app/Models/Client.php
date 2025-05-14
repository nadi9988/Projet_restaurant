<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'points_fidelite'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    // Accesseurs (Getters)
    public function getPointsFideliteAttribute($value)
    {
        return number_format($value, 0, '', ' ') . ' pts';
    }

    public function getFullNameAttribute()
    {
        return Str::title($this->user->first_name . ' ' . $this->user->last_name);
    }

    public function getLoyaltyLevelAttribute()
    {
        return match(true) {
            $this->points_fidelite >= 1000 => 'Or',
            $this->points_fidelite >= 500 => 'Argent',
            $this->points_fidelite >= 100 => 'Bronze',
            default => 'Nouveau'
        };
    }

    // Mutateurs (Setters)
    public function setPointsFideliteAttribute($value)
    {
        $this->attributes['points_fidelite'] = max(0, (int)preg_replace('/[^0-9]/', '', $value));
    }

    // Méthodes utilitaires
    public function addPoints($points)
    {
        $this->increment('points_fidelite', max(0, $points));
        return $this->fresh()->points_fidelite;
    }

    public function deductPoints($points)
    {
        $this->decrement('points_fidelite', min($this->points_fidelite, $points));
        return $this->fresh()->points_fidelite;
    }

    public function totalDepenses()
    {
        return $this->commandes()->sum('total_amount');
    }

    public function hasActiveReservation()
    {
        return $this->reservations()
            ->where('date', '>=', now())
            ->exists();
    }

    public function nextReservation()
    {
        return $this->reservations()
            ->where('date', '>=', now())
            ->orderBy('date')
            ->first();
    }

    public function canMakeReservation()
    {
        return $this->reservations()
            ->where('date', '>=', now()->subDays(30))
            ->count() < 5;
    }

    // Scopes
    public function scopeHighLoyalty($query)
    {
        return $query->where('points_fidelite', '>=', 500);
    }

    public function scopeWithActiveReservations($query)
    {
        return $query->whereHas('reservations', function($q) {
            $q->where('date', '>=', now());
        });
    }

    public function scopeRegisteredAfter($query, $date)
    {
        return $query->whereHas('user', function($q) use ($date) {
            $q->where('created_at', '>=', Carbon::parse($date));
        });
    }

    // Méthode de vérification de statut
    public function isVIP()
    {
        return $this->points_fidelite >= 1000 || $this->totalDepenses() >= 5000;
    }

    // Méthode de conversion des points
    public function convertPointsToDiscount($points)
    {
        $convertiblePoints = min($this->points_fidelite, $points);
        $this->deductPoints($convertiblePoints);
        return $convertiblePoints / 100; // 1% de réduction par point
    }

    // Dernière commande
    public function lastCommande()
    {
        return $this->commandes()->latest()->first();
    }
}