<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'date_time',
        'status',
        'total_amount',
        'payment_mode',
        'delivery_address',
        'is_delivery',
        'reservation_id',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'total_amount' => 'float',
        'is_delivery' => 'boolean',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function lignesCommande()
    {
        return $this->hasMany(LigneCommande::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    public function livraison()
    {
        return $this->hasOne(Livraison::class);
    }
    //Method . . .
}
