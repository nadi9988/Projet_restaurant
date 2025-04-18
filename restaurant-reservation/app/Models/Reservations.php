<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $fillable = [
        'client_id',
        'table_id',
        'date_time',
        'number_of_people',
        'status',
        'comments',
        'order_pre_dishes',
    ];
    protected $casts = [
        'date_time' => 'datetime',
        'number_of_people' => 'integer',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function commande()
    {
        return $this->hasOne(Commande::class);
    }
    // Method Soon . . . 
}
