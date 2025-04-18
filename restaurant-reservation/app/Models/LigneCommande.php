<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    protected $fillable = [
        'commande_id',
        'plat_id',
        'quantity',
        'unit_price',
        'instructions',
        ];
        protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }
    // Method Soon . . . 
}
