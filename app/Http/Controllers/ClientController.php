<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'         => 'required|string',
            'prenom'      => 'required|string',
            'email'       => 'required|email|unique:clients,email',
            'telephone'   => 'required|string',
            'cin'         => 'required|string|unique:clients,cin',
            'nationalite' => 'nullable|string',
            'adresse'     => 'nullable|string',        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
                         ->with('success', 'Client ajouté avec succès !');    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom'         => 'required|string',
            'prenom'      => 'required|string',
            'email'       => 'required|email|unique:clients,email,' . $client->id,
            'telephone'   => 'required|string',
            'cin'         => 'required|string|unique:clients,cin,' . $client->id,
            'nationalite' => 'nullable|string',
            'adresse'     => 'nullable|string',        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
                         ->with('success', 'Client modifié avec succès !');    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
                         ->with('success', 'Client supprimé avec succès !');    }

    public function historique(Client $client)
    {
        $client->load('reservations.chambre');
        return view('clients.historique', compact('client'));    }
}
