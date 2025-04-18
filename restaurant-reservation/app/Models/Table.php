<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'restaurant_id',
        'numero',
        'capacity',
        'available',
        'location',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    //Method Soon . . .
}
