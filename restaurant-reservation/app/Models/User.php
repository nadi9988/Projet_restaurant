<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Admin;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable // <-- Hérite d'Authenticatable
{

    protected $fillable = [
        'lastName',
        'firstName',
        'email',
        'password',
        'telephone',
        'InscriptionDate',
        'isActive',
        'type',
    ];
    
    protected $hidden = [
        'password',
        'rememberToken'
    ];
    
    protected $casts = [
        'InscriptionDate' => 'datetime',
        'isActive' => 'boolean'
    ];
 
    public function client() 
    {
        return $this->hasOne(Client::class); // relation 1-1
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    // is Admin or Client
    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    public function isClient()
    {
        return $this->type === 'client';
    }
    // Method Soon  . . .
}
/*
    one-to-one   === 1-1 === hasOne
    One to Many  === 1-* === hasMany
    Many to Many === *-* === belongsToMany
*/