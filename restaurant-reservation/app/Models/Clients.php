<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'user_id',
        'points_fidelite'
    ];

    public function user() {
        return $this->belongsTo(Users::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function commandes() {
        return $this->hasMany(Commande::class);
    }
    //Method Soon . . .
}
