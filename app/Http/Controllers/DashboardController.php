<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_chambres'     => Room::count(),
            'chambres_dispo'     => Room::where('statut', 'disponible')->count(),
            'chambres_occupees'  => Room::where('statut', 'occupee')->count(),
            'total_reservations' => Booking::count(),
            'reservations_actives' => Booking::where('statut_booking', 'confirme')->count(),
            'total_clients'      => User::where('role', 'client')->count(),
            'recettes_jour'      => Payment::whereDate('date_paiement', today())->sum('montant'),
            'recettes_mois'      => Payment::whereMonth('date_paiement', now()->month)->sum('montant'),
        ];

        $reservations_recentes = Booking::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'reservations_recentes'));
    }
}