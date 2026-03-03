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
<<<<<<< HEAD
        'cin',
        'nationalite',
        'adresse',
=======
        'adresse',
        'cin',
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}