<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'reservation_id',
        'paiement_id',
        'numero_facture',
        'montant_total',
        'date_emission',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
}