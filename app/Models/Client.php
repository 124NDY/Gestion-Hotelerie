<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'cin',
        'nationalite',
        'adresse',    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
