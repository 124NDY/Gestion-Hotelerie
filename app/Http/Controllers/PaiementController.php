<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with(['reservation.client', 'reservation.chambre'])->get();
        return view('paiements.index', compact('paiements'));
    }

    public function create(Request $request)
    {
        $reservation_id = $request->reservation_id;
        $reservation = Reservation::with(['client', 'chambre'])->findOrFail($reservation_id);
        
        // Calculer le montant automatiquement
        $dateArrivee = \Carbon\Carbon::parse($reservation->date_arrivee);
        $dateDepart = \Carbon\Carbon::parse($reservation->date_depart);
        $nuits = $dateArrivee->diffInDays($dateDepart);
        $montant = $nuits * $reservation->chambre->prix;

        return view('paiements.create', compact('reservation', 'montant', 'nuits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required',
            'statut' => 'required',
        ]);

        Paiement::create($request->all());

        // Mettre à jour le statut de la réservation en terminée
        Reservation::find($request->reservation_id)->update(['statut' => 'terminee']);

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès !');
    }

    public function facture(Paiement $paiement)
    {
        $paiement->load(['reservation.client', 'reservation.chambre']);
        return view('paiements.facture', compact('paiement'));
    }

    public function historique()
    {
        $paiements = Paiement::with(['reservation.client', 'reservation.chambre'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('paiements.historique', compact('paiements'));
    }
}