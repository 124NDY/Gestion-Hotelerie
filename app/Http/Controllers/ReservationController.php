<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use App\Models\Chambre;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['client', 'chambre'])->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $clients = Client::all();
        $chambres = Chambre::where('statut', 'disponible')->get();
        return view('reservations.create', compact('clients', 'chambres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'chambre_id' => 'required|exists:chambres,id',
            'date_arrivee' => 'required|date',
            'date_depart' => 'required|date|after:date_arrivee',
            'remarques' => 'nullable',
        ]);

        Reservation::create($request->all());

        // Changer le statut de la chambre en occupée
        Chambre::find($request->chambre_id)->update(['statut' => 'occupee']);

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès !');
    }

    public function annuler(Reservation $reservation)
    {
        $reservation->update(['statut' => 'annulee']);

        // Remettre la chambre disponible
        $reservation->chambre->update(['statut' => 'disponible']);

        return redirect()->route('reservations.index')->with('success', 'Réservation annulée avec succès !');
    }

    public function historique()
    {
        $reservations = Reservation::with(['client', 'chambre'])->orderBy('created_at', 'desc')->get();
        return view('reservations.historique', compact('reservations'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->chambre->update(['statut' => 'disponible']);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès !');
    }
}