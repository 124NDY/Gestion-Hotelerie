<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    protected $fillable = [
        'numero',
        'type',
<<<<<<< HEAD
        'prix_nuit',
=======
        'prix',
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
        'statut',
        'description',
        'image',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}