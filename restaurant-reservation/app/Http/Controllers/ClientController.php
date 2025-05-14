<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Affiche la liste des clients
     */
    public function index()
    {
        $clients = Client::with(['user', 'reservation', 'commandes'])
            ->withCount(['reservation', 'commandes'])
            ->orderBy('points_fidelite', 'desc')
            ->paginate(10);

        return view('clients.index', compact('clients'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $users = User::doesntHave('client')->get();
        return view('clients.create', compact('users'));
    }

    /**
     * Enregistre un nouveau client
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('clients', 'user_id')
            ],
            'points_fidelite' => 'required|integer|min:0'
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Client créé avec succès');
    }

    /**
     * Affiche les détails d'un client
     */
    public function show(Client $client)
    {
        $client->load([
            'user', 
            'reservation.table.restaurant',
            'commandes.lignesCommande.plat'
        ]);

        return view('clients.show', compact('client'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Client $client)
    {
        $users = User::whereDoesntHave('client')
            ->orWhere('id', $client->user_id)
            ->get();

        return view('clients.edit', compact('client', 'users'));
    }

    /**
     * Met à jour le client
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('clients', 'user_id')->ignore($client->id)
            ],
            'points_fidelite' => 'required|integer|min:0'
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Client mis à jour avec succès');
    }

    /**
     * Supprime le client
     */
    public function destroy(Client $client)
    {
        if($client->reservation()->exists() || $client->commandes()->exists()) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer un client avec des réservations ou commandes associées');
        }

        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès');
    }

    /**
     * Ajoute des points de fidélité
     */
    public function addPoints(Request $request, Client $client)
    {
        $request->validate(['points' => 'required|integer|min:1']);
        
        $client->increment('points_fidelite', $request->points);
        
        return back()->with('success', "{$request->points} points ajoutés avec succès");
    }

    /**
     * Déduit des points de fidélité
     */
    public function deductPoints(Request $request, Client $client)
    {
        $request->validate([
            'points' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($client) {
                    if ($client->points_fidelite < $value) {
                        $fail('Le solde des points est insuffisant');
                    }
                }
            ]
        ]);

        $client->decrement('points_fidelite', $request->points);
        
        return back()->with('success', "{$request->points} points déduits avec succès");
    }
}