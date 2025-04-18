<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    protected $fillable = [
        'lastName',
        'firstName',
        'phoneNumber',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
    // Method Soon . . .
}
