<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'email',
        'description',
    ];

    public function horaire()
    {
        return $this->hasOne(Horaire::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function menuCategories()
    {
        return $this->hasMany(MenuCategorie::class);
    }

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }
    //Method Soon . . .
}
