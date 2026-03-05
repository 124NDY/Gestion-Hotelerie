<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isClient()) {
            $bookings = Booking::with(['room'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $bookings = Booking::with(['user', 'room'])
                ->latest()
                ->paginate(10);
        }

        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorizeBooking($booking);
        $booking->load(['user', 'room', 'payment']);
        return view('bookings.show', compact('booking'));
    }

    public function create()
    {
        $rooms = Room::where('statut', 'disponible')->get();
        $clients = null;

        if (!auth()->user()->isClient()) {
            $clients = \App\Models\User::where('role', 'client')->get();
        }

        return view('bookings.create', compact('rooms', 'clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id'    => 'required|exists:rooms,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin'   => 'required|date|after:date_debut',
            'user_id'    => 'nullable|exists:users,id',
        ]);

        $room = Room::findOrFail($request->room_id);

        // Verifier la disponibilite
        $conflit = Booking::where('room_id', $request->room_id)
            ->where('statut_booking', 'confirme')
            ->where(function ($query) use ($request) {
                $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                      ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('date_debut', '<=', $request->date_debut)
                            ->where('date_fin', '>=', $request->date_fin);
                      });
            })->exists();

        if ($conflit) {
            return back()->withErrors(['date_debut' => 'Cette chambre est deja reservee pour ces dates.'])->withInput();
        }

        $dateDebut = \Carbon\Carbon::parse($request->date_debut);
        $dateFin   = \Carbon\Carbon::parse($request->date_fin);
        $nuits     = $dateDebut->diffInDays($dateFin);
        $total     = $nuits * $room->prix_nuit;

        $userId = auth()->user()->isClient() ? auth()->id() : $request->user_id;

        Booking::create([
            'user_id'        => $userId,
            'room_id'        => $request->room_id,
            'date_debut'     => $request->date_debut,
            'date_fin'       => $request->date_fin,
            'total_prix'     => $total,
            'statut_booking' => 'confirme',
        ]);

        $room->update(['statut' => 'occupee']);

        return redirect()->route('bookings.index')->with('success', 'Reservation creee avec succes.');
    }

    public function annuler(Booking $booking)
    {
        $this->authorizeBooking($booking);

        $booking->update(['statut_booking' => 'annule']);
        $booking->room->update(['statut' => 'disponible']);

        return back()->with('success', 'Reservation annulee.');
    }

    private function authorizeBooking(Booking $booking)
    {
        $user = auth()->user();
        if ($user->isClient() && $booking->user_id !== $user->id) {
            abort(403);
        }
    }
}