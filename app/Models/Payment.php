<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'montant',
        'date_paiement',
        'methode',
    ];

    protected $casts = [
        'date_paiement' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}