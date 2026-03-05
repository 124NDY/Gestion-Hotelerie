<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Console\Command;

class CheckBookingsStatus extends Command
{
    protected $signature   = 'bookings:check-status';
    protected $description = 'Repasse les chambres en disponible quand la reservation est terminee';

    public function handle()
    {
        $bookings = Booking::where('statut_booking', 'confirme')
            ->where('date_fin', '<', today())
            ->with('room')
            ->get();

        foreach ($bookings as $booking) {
            $booking->room->update(['statut' => 'disponible']);
            $this->info('Chambre ' . $booking->room->numero . ' repassee en disponible.');
        }

        $this->info('Verification terminee. ' . $bookings->count() . ' chambre(s) mise(s) a jour.');
    }
}