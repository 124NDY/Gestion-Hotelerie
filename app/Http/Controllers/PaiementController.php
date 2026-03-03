<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $paiements = Paiement::with(['reservation.client', 'reservation.chambre'])
                             ->latest()->paginate(10);
        return view('paiements.index', compact('paiements'));
    }

    public function create()
    {
        $reservations = Reservation::with('client')
                                   ->where('statut', 'confirmee')
                                   ->get();
        return view('paiements.create', compact('reservations'));
=======
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
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
<<<<<<< HEAD
            'montant'        => 'required|numeric|min:0',
            'methode'        => 'required|in:espece,carte,virement',
            'statut'         => 'required|in:paye,en_attente,rembourse',
            'date_paiement'  => 'required|date',
=======
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required',
            'statut' => 'required',
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
        ]);

        Paiement::create($request->all());

<<<<<<< HEAD
        return redirect()->route('paiements.index')
                         ->with('success', 'Paiement enregistré avec succès !');
    }

    public function show(Paiement $paiement)
    {
        $paiement->load(['reservation.client', 'reservation.chambre']);
        return view('paiements.show', compact('paiement'));
    }

    public function edit(Paiement $paiement)
    {
        $reservations = Reservation::with('client')->get();
        return view('paiements.edit', compact('paiement', 'reservations'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'montant'        => 'required|numeric|min:0',
            'methode'        => 'required|in:espece,carte,virement',
            'statut'         => 'required|in:paye,en_attente,rembourse',
            'date_paiement'  => 'required|date',
        ]);

        $paiement->update($request->all());

        return redirect()->route('paiements.index')
                         ->with('success', 'Paiement modifié avec succès !');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return redirect()->route('paiements.index')
                         ->with('success', 'Paiement supprimé avec succès !');
=======
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
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }
}