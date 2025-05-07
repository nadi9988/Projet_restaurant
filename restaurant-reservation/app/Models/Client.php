<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'points_fidelite'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }

    public function commandes() {
        return $this->hasMany(Commande::class);
    }
    //Method Soon . . .
}
