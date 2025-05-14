<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Livraison extends Model
{
    protected $fillable = [
        'commande_id',
        'livreur_id',
        'address',
        'status',
        'review_start_time',
        'estimated_arrival_time',
    ];

    protected $casts = [
        'review_start_time' => 'datetime',
        'estimated_arrival_time' => 'datetime',
    ];

    // Relations
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class); 
    }

    // Accesseurs (Getters)
    public function getStatusAttribute($value)
    {
        $statuses = [
            'pending' => 'En attente',
            'in_progress' => 'En cours',
            'delayed' => 'Retardée',
            'delivered' => 'Livrée',
            'canceled' => 'Annulée'
        ];

        return $statuses[$value] ?? Str::title(str_replace('_', ' ', $value));
    }

    public function getAddressAttribute($value)
    {
        return "📍 " . Str::title($value);
    }

    public function getEstimatedArrivalTimeAttribute($value)
    {
        return $value ? $value->format('d/m/Y H:i') : 'Non estimé';
    }

    // Mutateurs (Setters)
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = trim(Str::lower($value));
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = Str::snake(trim($value));
    }

    public function setLivreurIdAttribute($value)
    {
        $this->attributes['livreur_id'] = (int)$value;
    }

    // Méthodes utilitaires
    public function isDelivered()
    {
        return $this->status === 'delivered';
    }

    public function timeRemaining()
    {
        if (!$this->estimated_arrival_time) {
            return null;
        }

        $now = Carbon::now();
        return $now->diffForHumans($this->estimated_arrival_time, [
            'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
            'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS
        ]);
    }

    public function isDelayed()
    {
        return $this->estimated_arrival_time 
            && Carbon::now()->gt($this->estimated_arrival_time);
    }

    public function getStatusColor()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'delivered' => 'bg-green-100 text-green-800',
            'delayed', 'canceled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    // Méthode pour démarrer la révision
    public function startReview()
    {
        $this->update([
            'review_start_time' => now(),
            'status' => 'in_progress'
        ]);
    }

    // Méthode pour marquer comme livré
    public function markAsDelivered()
    {
        $this->update([
            'status' => 'delivered',
            'estimated_arrival_time' => now()
        ]);
    }
}