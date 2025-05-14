<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    // Relations Eloquent
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

    // Accesseurs et Mutateurs

    /**
     * Formate la date/heure lors de la récupération
     */
    public function getDateTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }

    /**
     * Garantit que le nombre de personnes est au moins 1
     */
    public function setNumberOfPeopleAttribute($value)
    {
        $this->attributes['number_of_people'] = max(1, (int)$value);
    }

    /**
     * Nettoie et valide le statut
     */
    public function setStatusAttribute($value)
    {
        $allowedStatuses = ['confirmed', 'pending', 'cancelled'];
        $cleanValue = strtolower(trim($value));
        $this->attributes['status'] = in_array($cleanValue, $allowedStatuses) 
            ? $cleanValue 
            : 'pending';
    }

    /**
     * Convertit les plats pré-commandés en array lors de la récupération
     */
    public function getOrderPreDishesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Convertit les plats pré-commandés en JSON lors de l'enregistrement
     */
    public function setOrderPreDishesAttribute($value)
    {
        $this->attributes['order_pre_dishes'] = json_encode($value);
    }

    // Méthode supplémentaire d'exemple (à adapter selon vos besoins)
    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }
}