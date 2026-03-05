<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'type',
        'prix_nuit',
        'description',
        'photo_url',
        'statut',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}