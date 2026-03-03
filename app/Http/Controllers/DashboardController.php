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
        $stats = [
            'chambres_disponibles' => Chambre::where('statut', 'disponible')->count(),
            'chambres_occupees'    => Chambre::where('statut', 'occupee')->count(),
            'total_clients'        => Client::count(),
            'reservations_today'   => Reservation::whereDate('date_arrivee', today())->count(),
            'reservations_confirmees' => Reservation::where('statut', 'confirmee')->count(),
            'revenus_mois'         => Paiement::whereMonth('date_paiement', now()->month)
                                               ->where('statut', 'paye')
                                               ->sum('montant'),
        ];

        // Graphique réservations par mois
        $reservations_mois = Reservation::selectRaw('MONTH(date_arrivee) as mois, COUNT(*) as total')
            ->whereYear('date_arrivee', date('Y'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Dernières réservations
        $dernieres_reservations = Reservation::with(['client', 'chambre'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'reservations_mois', 'dernieres_reservations'));
    }
}