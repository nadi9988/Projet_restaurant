<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{
    protected $fillable = [
        'restaurant_id',
        'opening_time',
        'exceptional_days',
    ];

    protected $casts = [
        'opening_time' => 'array',
        'exceptional_days' => 'array',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    //Method Soon . . .
}
