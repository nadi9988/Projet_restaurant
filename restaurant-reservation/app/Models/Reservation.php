<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_id',
        'restaurant_id',
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
        return $this->belongsTo(Client::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
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
