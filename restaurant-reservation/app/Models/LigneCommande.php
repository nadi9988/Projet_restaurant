<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NumberFormatter;

class LigneCommande extends Model
{
    protected $fillable = [
        'commande_id',
        'plat_id',
        'quantity',
        'unit_price',
        'instructions',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
    ];

    // Relations
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }

    // Accesseurs (Getters)
    public function getUnitPriceAttribute($value)
    {
        return number_format($value, 2, ',', ' ') . ' MAD';
    }

    public function getTotalPriceAttribute()
    {
        return number_format($this->quantity * $this->unit_price, 2, ',', ' ') . ' MAD';
    }

    public function getInstructionsAttribute($value)
    {
        if(empty($value)) {
            return "Aucune instruction spécifique";
        }
        return Str::ucfirst(trim($value)) . (Str::endsWith($value, '.') ? '' : '.');
    }

    // Mutateurs (Setters)
    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = max(1, (int)$value);
    }

    public function setUnitPriceAttribute($value)
    {
        $cleanValue = (float)preg_replace('/[^0-9,.]/', '', str_replace(',', '.', $value));
        $this->attributes['unit_price'] = round($cleanValue, 2);
    }

    public function setInstructionsAttribute($value)
    {
        $this->attributes['instructions'] = trim(Str::lower($value));
    }

    // Méthodes utilitaires
    public function totalRaw()
    {
        return $this->quantity * $this->unit_price;
    }

    public function isValid()
    {
        return $this->plat->available && ($this->quantity > 0);
    }

    public function updateQuantity($newQuantity)
    {
        $this->quantity = max(1, $newQuantity);
        $this->save();
        $this->commande->recalculateTotal();
    }

    public function getFormattedInstructions($maxLength = 50)
    {
        return Str::limit($this->instructions, $maxLength, ' (...)');
    }

    public function getPriceInWords()
    {
        $formatter = new NumberFormatter('fr_MA', NumberFormatter::SPELLOUT);
        $total = $this->quantity * $this->unit_price;
        return Str::ucfirst($formatter->format($total)) . ' dirhams';
    }

    // Scopes
    public function scopeForPlat($query, $platId)
    {
        return $query->where('plat_id', $platId);
    }

    public function scopeWithInstructions($query)
    {
        return $query->whereNotNull('instructions')->where('instructions', '!=', '');
    }

    // Méthode de vérification stock
    public function isStockSufficient()
    {
        return $this->plat->stock >= $this->quantity;
    }
}