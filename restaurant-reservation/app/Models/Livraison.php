<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}
