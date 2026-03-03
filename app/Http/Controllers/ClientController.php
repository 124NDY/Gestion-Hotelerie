<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $clients = Client::latest()->paginate(10);
=======
        $clients = Client::all();
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'nom'         => 'required|string',
            'prenom'      => 'required|string',
            'email'       => 'required|email|unique:clients,email',
            'telephone'   => 'required|string',
            'cin'         => 'required|string|unique:clients,cin',
            'nationalite' => 'nullable|string',
            'adresse'     => 'nullable|string',
=======
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients',
            'telephone' => 'required',
            'adresse' => 'nullable',
            'cin' => 'required|unique:clients',
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
        ]);

        Client::create($request->all());

<<<<<<< HEAD
        return redirect()->route('clients.index')
                         ->with('success', 'Client ajouté avec succès !');
=======
        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès !');
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
<<<<<<< HEAD
            'nom'         => 'required|string',
            'prenom'      => 'required|string',
            'email'       => 'required|email|unique:clients,email,' . $client->id,
            'telephone'   => 'required|string',
            'cin'         => 'required|string|unique:clients,cin,' . $client->id,
            'nationalite' => 'nullable|string',
            'adresse'     => 'nullable|string',
=======
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email,'.$client->id,
            'telephone' => 'required',
            'adresse' => 'nullable',
            'cin' => 'required|unique:clients,cin,'.$client->id,
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
        ]);

        $client->update($request->all());

<<<<<<< HEAD
        return redirect()->route('clients.index')
                         ->with('success', 'Client modifié avec succès !');
=======
        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès !');
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }

    public function destroy(Client $client)
    {
        $client->delete();
<<<<<<< HEAD

        return redirect()->route('clients.index')
                         ->with('success', 'Client supprimé avec succès !');
=======
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès !');
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }

    public function historique(Client $client)
    {
<<<<<<< HEAD
        $client->load('reservations.chambre');
        return view('clients.historique', compact('client'));
=======
        $reservations = $client->reservations()->with('chambre')->get();
        return view('clients.historique', compact('client', 'reservations'));
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    }
}