<?php

namespace App\Models;

use App\Enums\CommandeStatus;
use App\Enums\PaymentMode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use NumberFormatter;
use Carbon\Carbon;
use Illuminate\Support\Str; // <-- Ajoutez cette ligne


class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'reservation_id',
        'date_time',
        'status',
        'total_amount',
        'payment_mode',
        'delivery_address',
        'is_delivery',
        'notes'
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'total_amount' => 'decimal:2',
        'is_delivery' => 'boolean',
        'status' => CommandeStatus::class,
        'payment_mode' => PaymentMode::class,
    ];

    // Relations
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function lignesCommande(): HasMany
    {
        return $this->hasMany(LigneCommande::class);
    }

    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }

    public function livraison(): HasOne
    {
        return $this->hasOne(Livraison::class);
    }

    // Accesseurs
    public function getFormattedStatusAttribute(): string
    {
        return $this->status->label();
    }

    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->total_amount, 2, ',', ' ') . ' MAD';
    }

    public function getDeliveryAddressFormattedAttribute(): string
    {
        if(!$this->is_delivery) return 'Retrait sur place';
        return $this->delivery_address ? "📍 " . Str::title($this->delivery_address) : 'Adresse non spécifiée';
    }

    // Mutateurs
    public function setDeliveryAddressAttribute(?string $value): void
    {
        $this->attributes['delivery_address'] = $value ? Str::title(trim($value)) : null;
    }

    // Méthodes métier
    public function recalculateTotal(): float
    {
        $total = $this->lignesCommande->sum(fn($ligne) => 
            $ligne->quantity * $ligne->price
        );

        $this->update(['total_amount' => $total]);
        return $total;
    }

    public function markAsPaid(): bool
    {
        return $this->paiement?->markAsCompleted() ?? false;
    }

    public function updateStatus(CommandeStatus $newStatus): bool
    {
        if($this->status->canTransitionTo($newStatus)) {
            $this->update(['status' => $newStatus]);
            
            if($newStatus === CommandeStatus::LIVREE) {
                $this->livraison?->markAsDelivered();
            }
            
            return true;
        }
        
        return false;
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', CommandeStatus::EN_ATTENTE);
    }

    public function scopeForToday($query)
    {
        return $query->whereDate('date_time', today());
    }

    public function scopeBetweenDates($query, Carbon $start, Carbon $end)
    {
        return $query->whereBetween('date_time', [
            $start->startOfDay(),
            $end->endOfDay()
        ]);
    }

    public function scopeWithPaymentMode($query, PaymentMode $mode)
    {
        return $query->where('payment_mode', $mode);
    }

    // Validation
    public function canBeModified(): bool
    {
        return !in_array($this->status, [
            CommandeStatus::LIVREE,
            CommandeStatus::ANNULEE
        ]);
    }

    public function requiresDelivery(): bool
    {
        return $this->is_delivery && $this->delivery_address;
    }
}