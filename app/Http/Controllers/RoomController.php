<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(12);
        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero'      => 'required|unique:rooms,numero',
            'type'        => 'required|string',
            'prix_nuit'   => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'photo'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photoPath = $request->file('photo')->store('rooms', 'public');

        Room::create([
            'numero'      => $request->numero,
            'type'        => $request->type,
            'prix_nuit'   => $request->prix_nuit,
            'description' => $request->description,
            'photo_url'   => $photoPath,
            'statut'      => 'disponible',
        ]);

        return redirect()->route('rooms.index')->with('success', 'Chambre ajoutee avec succes.');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'numero'      => 'required|unique:rooms,numero,' . $room->id,
            'type'        => 'required|string',
            'prix_nuit'   => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'numero'      => $request->numero,
            'type'        => $request->type,
            'prix_nuit'   => $request->prix_nuit,
            'description' => $request->description,
        ];

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($room->photo_url);
            $data['photo_url'] = $request->file('photo')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()->route('rooms.index')->with('success', 'Chambre mise a jour.');
    }

    public function updateStatut(Request $request, Room $room)
    {
        $statut = $request->query('statut');
    
        if (!in_array($statut, ['disponible', 'occupee', 'menage'])) {
            return back()->with('error', 'Statut invalide.');
        }
    
        // Verifier si une reservation active existe avant de forcer disponible
        if ($statut === 'disponible') {
            $reservationActive = $room->bookings()
                ->where('statut_booking', 'confirme')
                ->where('date_fin', '>=', today())
                ->exists();
    
            if ($reservationActive) {
                return back()->with('error', 'Impossible de liberer cette chambre : une reservation active existe encore.');
            }
        }
    
        $room->update(['statut' => $statut]);
    
        return back()->with('success', 'Statut mis a jour.');
    }

    public function destroy(Room $room)
    {
        Storage::disk('public')->delete($room->photo_url);
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Chambre supprimee.');
    }
}