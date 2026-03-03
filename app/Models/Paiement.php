<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'reservation_id',
        'montant',
<<<<<<< HEAD
        'methode',
        'statut',
        'date_paiement',
=======
        'date_paiement',
        'mode_paiement',
        'statut',
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
<<<<<<< HEAD

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
=======
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
}