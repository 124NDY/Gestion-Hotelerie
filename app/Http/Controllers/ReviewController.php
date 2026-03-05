<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_id'  => 'required|exists:bookings,id',
            'note'        => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:500',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->review) {
            return back()->with('info', 'Vous avez deja laisse un avis pour ce sejour.');
        }

        if ($booking->statut_booking !== 'confirme' && $booking->date_fin > today()) {
            return back()->with('info', 'Vous ne pouvez laisser un avis qu apres votre sejour.');
        }

        Review::create([
            'user_id'     => auth()->id(),
            'booking_id'  => $request->booking_id,
            'note'        => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Avis enregistre, merci.');
    }

    public function index()
    {
        $reviews = Review::with(['user', 'booking.room'])
            ->latest()
            ->paginate(10);

        $moyenne = Review::avg('note');

        return view('reviews.index', compact('reviews', 'moyenne'));
    }
}