<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'commande_id',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'reference',
    ];

    protected $casts = [
        'amount' => 'float',
        'payment_date' => 'datetime',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    // Method Soon . . .
}
