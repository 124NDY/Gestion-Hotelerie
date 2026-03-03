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
        'montant_total',
        'notes',
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

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
}