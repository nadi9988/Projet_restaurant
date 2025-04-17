<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrators extends Model
{
    protected $fillable = [
        'user_id',
        'role'
    ];

    public function user () {
        return $this->belongsTo(Users::class);
    }
    // Method Soon . . .
}
