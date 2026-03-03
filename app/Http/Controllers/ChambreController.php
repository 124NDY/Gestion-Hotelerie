<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $chambres = Chambre::latest()->paginate(10);
=======
        $chambres = Chambre::all();
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
        return view('chambres.index', compact('chambres'));
    }

    public function create()
    {
        return view('chambres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
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
=======
            'numero' => 'required|unique:chambres',
            'type' => 'required',
            'prix' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chambres', 'public');
        }

        Chambre::create($data);

        return redirect()->route('chambres.index')->with('success', 'Chambre ajoutée avec succès !');
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }

    public function edit(Chambre $chambre)
    {
        return view('chambres.edit', compact('chambre'));
    }

    public function update(Request $request, Chambre $chambre)
    {
        $request->validate([
<<<<<<< HEAD
            'numero'    => 'required|string|unique:chambres,numero,' . $chambre->id,
            'type'      => 'required|string',
            'prix_nuit' => 'required|numeric|min:0',
            'statut'    => 'required|in:disponible,occupee',
            'description' => 'nullable|string',
        ]);

        $chambre->update($request->all());

        return redirect()->route('chambres.index')
                         ->with('success', 'Chambre modifiée avec succès !');
=======
            'numero' => 'required|unique:chambres,numero,'.$chambre->id,
            'type' => 'required',
            'prix' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chambres', 'public');
        }

        $chambre->update($data);

        return redirect()->route('chambres.index')->with('success', 'Chambre modifiée avec succès !');
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }

    public function destroy(Chambre $chambre)
    {
        $chambre->delete();
<<<<<<< HEAD

        return redirect()->route('chambres.index')
                         ->with('success', 'Chambre supprimée avec succès !');
=======
        return redirect()->route('chambres.index')->with('success', 'Chambre supprimée avec succès !');
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }
}