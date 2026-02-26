<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Paiement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalChambres = Chambre::count();
        $chambresDisponibles = Chambre::where('statut', 'disponible')->count();
        $chambresOccupees = Chambre::where('statut', 'occupee')->count();
        $totalClients = Client::count();
        $reservationsActives = Reservation::where('statut', 'active')->count();
        $totalReservations = Reservation::count();
        $totalPaiements = Paiement::where('statut', 'paye')->sum('montant');

        return view('dashboard', compact(
            'totalChambres',
            'chambresDisponibles',
            'chambresOccupees',
            'totalClients',
            'reservationsActives',
            'totalReservations',
            'totalPaiements'
        ));
    }
}