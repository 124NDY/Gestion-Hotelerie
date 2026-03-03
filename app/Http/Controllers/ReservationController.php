<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Chambre;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['client', 'chambre'])->latest()->paginate(10);        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $clients  = Client::all();        $chambres = Chambre::where('statut', 'disponible')->get();
        return view('reservations.create', compact('clients', 'chambres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'    => 'required|exists:clients,id',
            'chambre_id'   => 'required|exists:chambres,id',
            'date_arrivee' => 'required|date',
            'date_depart'  => 'required|date|after:date_arrivee',
            'notes'        => 'nullable|string',
        ]);

        // Vérifier disponibilité
        $conflit = Reservation::where('chambre_id', $request->chambre_id)
            ->where('statut', 'confirmee')
            ->where(function($q) use ($request) {
                $q->whereBetween('date_arrivee', [$request->date_arrivee, $request->date_depart])
                  ->orWhereBetween('date_depart', [$request->date_arrivee, $request->date_depart]);
            })->exists();

        if ($conflit) {
            return back()->withErrors(['chambre_id' => 'Cette chambre est déjà réservée pour ces dates.'])->withInput();
        }

        // Calcul montant
        $chambre = Chambre::findOrFail($request->chambre_id);
        $nuits   = Carbon::parse($request->date_arrivee)->diffInDays($request->date_depart);
        $montant = $nuits * $chambre->prix_nuit;

        // Créer réservation
        Reservation::create([
            'client_id'     => $request->client_id,
            'chambre_id'    => $request->chambre_id,
            'date_arrivee'  => $request->date_arrivee,
            'date_depart'   => $request->date_depart,
            'montant_total' => $montant,
            'statut'        => 'confirmee',
            'notes'         => $request->notes,
        ]);

        // Changer statut chambre
        $chambre->update(['statut' => 'occupee']);

        return redirect()->route('reservations.index')
                         ->with('success', 'Réservation créée avec succès !');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['client', 'chambre']);
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $clients  = Client::all();
        $chambres = Chambre::all();
        return view('reservations.edit', compact('reservation', 'clients', 'chambres'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'client_id'    => 'required|exists:clients,id',
            'chambre_id'   => 'required|exists:chambres,id',
            'date_arrivee' => 'required|date',
            'date_depart'  => 'required|date|after:date_arrivee',
            'statut'       => 'required|in:confirmee,annulee,terminee',
            'notes'        => 'nullable|string',
        ]);

        $chambre = Chambre::findOrFail($request->chambre_id);
        $nuits   = Carbon::parse($request->date_arrivee)->diffInDays($request->date_depart);
        $montant = $nuits * $chambre->prix_nuit;

        $reservation->update([
            'client_id'     => $request->client_id,
            'chambre_id'    => $request->chambre_id,
            'date_arrivee'  => $request->date_arrivee,
            'date_depart'   => $request->date_depart,
            'montant_total' => $montant,
            'statut'        => $request->statut,
            'notes'         => $request->notes,
        ]);

        return redirect()->route('reservations.index')
                         ->with('success', 'Réservation modifiée avec succès !');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')
                         ->with('success', 'Réservation supprimée !');    }

    public function annuler(Reservation $reservation)
    {
        $reservation->update(['statut' => 'annulee']);
        $reservation->chambre->update(['statut' => 'disponible']);

        return redirect()->route('reservations.index')
                         ->with('success', 'Réservation annulée avec succès !');    }
}
