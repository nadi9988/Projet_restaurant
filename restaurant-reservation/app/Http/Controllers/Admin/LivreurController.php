<?php

namespace App\Http\Controllers\Admin; // <─ Déplacement dans le namespace Admin

use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class LivreurController extends Controller
{

    public function index()
    {
        $livreurs = Livreur::withCount('livraisons')
            ->orderBy('lastName')
            ->paginate(10);

        return view('admin.livreur.index', compact('livreurs')); // <─ Chemin admin
    }

    public function create()
    {
        return view('admin.livreur.create'); // <─ Chemin admin
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'phoneNumber' => [
                'required',
                'string',
                'max:20',
                Rule::unique('livreurs') // <─ Correction: suppression du ignore() inutile
            ],
            'is_available' => 'sometimes|boolean'
        ]);

        Livreur::create($validated);

        return redirect()->route('admin.livreur.index') // <─ Route admin
            ->with('success', 'Livreur ajouté avec succès');
    }

    public function show(Livreur $livreur)
    {
        $livreur->load('livraisons.commande.client'); // <─ Chargement optimisé
        return view('admin.livreurs.show', compact('livreur')); // <─ Chemin admin
    }

    public function edit(Livreur $livreur)
    {
        return view('admin.livreur.edit', compact('livreur')); // <─ Chemin admin
    }

    public function update(Request $request, Livreur $livreur)
    {
        $validated = $request->validate([
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'phoneNumber' => [
                'required',
                'string',
                'max:20',
                Rule::unique('livreurs')->ignore($livreur->id) // <─ Correction: ignore avec ID
            ],
            'is_available' => 'required|boolean' // <─ Changement à required
        ]);

        $livreur->update($validated);

        return redirect()->route('admin.livreur.index') // <─ Route admin
            ->with('success', 'Livreur mis à jour avec succès');
    }

    public function destroy(Livreur $livreur)
    {
        abort_if($livreur->livraisons()->exists(), 403, // <─ Utilisation de abort_if
            'Impossible de supprimer un livreur avec des livraisons actives');

        $livreur->delete();

        return redirect()->route('admin.livreur.index') // <─ Route admin
            ->with('success', 'Livreur supprimé avec succès');
    }
}
