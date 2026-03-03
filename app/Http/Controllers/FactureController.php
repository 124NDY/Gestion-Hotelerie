<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    // 📋 Liste des factures
    public function index()
    {
        $factures = Facture::with(['reservation.client', 'reservation.chambre'])
                           ->latest()->paginate(10);
        return view('factures.index', compact('factures'));
    }

    // 🧾 Générer une facture pour une réservation
    public function generer(Reservation $reservation)
    {
        // Vérifier si une facture existe déjà
        $facture = Facture::where('reservation_id', $reservation->id)->first();

        if (!$facture) {
            // Récupérer le paiement lié
            $paiement = Paiement::where('reservation_id', $reservation->id)->firstOrFail();

            // Numéro automatique
            $lastId  = Facture::max('id') ?? 0;
            $numero  = 'FAC-' . date('Y') . '-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

            // Créer la facture
            $facture = Facture::create([
                'reservation_id' => $reservation->id,
                'paiement_id'    => $paiement->id,
                'numero_facture' => $numero,
                'montant_total'  => $reservation->montant_total,
                'date_emission'  => Carbon::today(),
            ]);
        }

        return redirect()->route('factures.pdf', $facture->id)
                         ->with('success', 'Facture générée avec succès !');
    }

    // 📥 Télécharger le PDF
    public function pdf(Facture $facture)
    {
        $facture->load(['reservation.client', 'reservation.chambre', 'paiement']);

        $pdf = Pdf::loadView('factures.template', compact('facture'));

        return $pdf->download('facture-' . $facture->numero_facture . '.pdf');
    }
}