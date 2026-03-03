<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index()
    {
        $chambres = Chambre::latest()->paginate(10);
        return view('chambres.index', compact('chambres'));
    }

    public function create()
    {
        return view('chambres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero'    => 'required|string|unique:chambres,numero',
            'type'      => 'required|string',
            'prix_nuit' => 'required|numeric|min:0',
            'statut'    => 'required|in:disponible,occupee',
            'description' => 'nullable|string',
        ]);

        Chambre::create($request->all());

        return redirect()->route('chambres.index')
                         ->with('success', 'Chambre ajoutée avec succès !');
    }

    public function show(Chambre $chambre)
    {
        return view('chambres.show', compact('chambre'));
    }

    public function edit(Chambre $chambre)
    {
        return view('chambres.edit', compact('chambre'));
    }

    public function update(Request $request, Chambre $chambre)
    {
        $request->validate([
            'numero'    => 'required|string|unique:chambres,numero,' . $chambre->id,
            'type'      => 'required|string',
            'prix_nuit' => 'required|numeric|min:0',
            'statut'    => 'required|in:disponible,occupee',
            'description' => 'nullable|string',
        ]);

        $chambre->update($request->all());

        return redirect()->route('chambres.index')
                         ->with('success', 'Chambre modifiée avec succès !');
    }

    public function destroy(Chambre $chambre)
    {
        $chambre->delete();

        return redirect()->route('chambres.index')
                         ->with('success', 'Chambre supprimée avec succès !');
    }
}