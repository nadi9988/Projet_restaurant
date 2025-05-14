<?php

namespace App\Http\Controllers;

use App\Models\LigneCommande;
use App\Models\Commande;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LigneCommandeController extends Controller
{
    /**
     * Affiche la liste des lignes de commande
     */
    public function index()
    {
        $lignes = LigneCommande::with(['commande', 'plat'])
            ->orderBy('commande_id')
            ->paginate(15);

        return view('ligne-commandes.index', compact('lignes'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $commandes = Commande::all();
        $plats = Plat::where('available', true)->get();
        
        return view('ligne-commandes.create', compact('commandes', 'plats'));
    }

    /**
     * Enregistre une nouvelle ligne de commande
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'plat_id' => [
                'required',
                'exists:plats,id',
                function ($attribute, $value, $fail) use ($request) {
                    $plat = Plat::find($value);
                    if (!$plat->available) {
                        $fail('Le plat sélectionné n\'est pas disponible');
                    }
                }
            ],
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0.01',
            'instructions' => 'nullable|string|max:500'
        ]);

        LigneCommande::create($validated);

        return redirect()->route('ligne-commandes.index')
            ->with('success', 'Ligne de commande ajoutée avec succès');
    }

    /**
     * Affiche les détails d'une ligne de commande
     */
    public function show(LigneCommande $ligneCommande)
    {
        $ligneCommande->load(['commande.client', 'plat.menuCategorie']);
        return view('ligne-commandes.show', compact('ligneCommande'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(LigneCommande $ligneCommande)
    {
        $commandes = Commande::all();
        $plats = Plat::where('available', true)
            ->orWhere('id', $ligneCommande->plat_id)
            ->get();

        return view('ligne-commandes.edit', compact('ligneCommande', 'commandes', 'plats'));
    }

    /**
     * Met à jour la ligne de commande
     */
    public function update(Request $request, LigneCommande $ligneCommande)
    {
        $validated = $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'plat_id' => [
                'required',
                'exists:plats,id',
                function ($attribute, $value, $fail) {
                    $plat = Plat::find($value);
                    if (!$plat->available) {
                        $fail('Le plat sélectionné n\'est pas disponible');
                    }
                }
            ],
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0.01',
            'instructions' => 'nullable|string|max:500'
        ]);

        $ligneCommande->update($validated);

        return redirect()->route('ligne-commandes.index')
            ->with('success', 'Ligne de commande mise à jour avec succès');
    }

    /**
     * Supprime la ligne de commande
     */
    public function destroy(LigneCommande $ligneCommande)
    {
        $ligneCommande->delete();
        return redirect()->route('ligne-commandes.index')
            ->with('success', 'Ligne de commande supprimée avec succès');
    }
}