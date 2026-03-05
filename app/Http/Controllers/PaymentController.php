<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['booking.user', 'booking.room'])
            ->latest()
            ->paginate(10);

        $total_jour = Payment::whereDate('date_paiement', today())->sum('montant');
        $total_mois = Payment::whereMonth('date_paiement', now()->month)->sum('montant');

        return view('payments.index', compact('payments', 'total_jour', 'total_mois'));
    }

    public function create(Booking $booking)
    {
        if ($booking->payment) {
            return redirect()->route('payments.facture', $booking->payment)->with('info', 'Ce paiement existe deja.');
        }

        $booking->load(['user', 'room']);
        return view('payments.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'methode'    => 'required|in:especes,carte,virement',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->payment) {
            return back()->withErrors(['booking_id' => 'Ce paiement existe deja.']);
        }

        $payment = Payment::create([
            'booking_id'     => $booking->id,
            'montant'        => $booking->total_prix,
            'date_paiement'  => today(),
            'methode'        => $request->methode,
        ]);

        return redirect()->route('payments.facture', $payment)->with('success', 'Paiement enregistre.');
    }

    public function facture(Payment $payment)
    {
        $payment->load(['booking.user', 'booking.room']);
        return view('payments.facture', compact('payment'));
    }
    
    public function facturePdf(Payment $payment)
    {
        $payment->load(['booking.user', 'booking.room']);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('payments.facture_pdf', compact('payment'));
        return $pdf->download('facture-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
}