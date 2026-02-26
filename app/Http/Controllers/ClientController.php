<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients',
            'telephone' => 'required',
            'adresse' => 'nullable',
            'cin' => 'required|unique:clients',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès !');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email,'.$client->id,
            'telephone' => 'required',
            'adresse' => 'nullable',
            'cin' => 'required|unique:clients,cin,'.$client->id,
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès !');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès !');
    }

    public function historique(Client $client)
    {
        $reservations = $client->reservations()->with('chambre')->get();
        return view('clients.historique', compact('client', 'reservations'));
    }
}