<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_id',
        'chambre_id',
        'date_arrivee',
        'date_depart',
        'statut',
<<<<<<< HEAD
        'montant_total',
        'notes',
=======
        'remarques',
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
<<<<<<< HEAD

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
=======
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
}