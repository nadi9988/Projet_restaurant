<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Administrator;


class Users extends Model
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
    // LinK Users with Client and Adminitrator(cardinalité)
    // la79ax ila mxiti l diagrame gha tl9a ghi houma li las9in fiha
    // sma3ti a Kniksi !

    public function client() 
    {
        return $this->hasOne(Client::class); // relation 1-1
    }

    public function admin()
    {
        return $this->hasOne(Administrators::class);
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