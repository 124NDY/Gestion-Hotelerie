<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
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
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'montant'        => 'required|numeric|min:0',
            'methode'        => 'required|in:espece,carte,virement',
            'statut'         => 'required|in:paye,en_attente,rembourse',
            'date_paiement'  => 'required|date',
        ]);

        Paiement::create($request->all());

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
    }
}