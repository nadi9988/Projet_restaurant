<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategorie extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function plats()
    {
        return $this->hasMany(Plat::class);
    }
    // Method Soon . . . 
}
