<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plat;
use App\Models\MenuCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PlatController extends Controller
{
    /**
     * Affiche la liste des plats avec filtres
     */
    public function index()
    {
        $plats = Plat::query()
            ->with(['menuCategorie.restaurant', 'commandes'])
            ->when(request('categorie'), fn($q) => $q->where('menu_categorie_id', request('categorie')))
            ->when(request('disponible'), fn($q) => $q->where('available', true))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = MenuCategorie::pluck('name', 'id');

        return view('admin.plat.index', compact('plats', 'categories'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.plat.create', [
            'categories' => MenuCategorie::with('restaurant')->active()->get()
        ]);
    }

    /**
     * Enregistre un nouveau plat avec gestion d'image
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('plats', 'public');
        }

        $plat = Plat::create($validated);

        return redirect()->route('admin.plat.show', $plat)
            ->with('success', 'Plat créé avec succès');
    }

    /**
     * Affiche les détails du plat avec statistiques
     */
    public function show(Plat $plat)
    {
        $plat->load([
            'menuCategorie.restaurant',
            'commandes' => fn($q) => $q->latest()->limit(5)
        ]);

        return view('admin.plat.show', compact('plat'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Plat $plat)
    {
        return view('admin.plat.edit', [
            'plat' => $plat,
            'categories' => MenuCategorie::with('restaurant')->active()->get()
        ]);
    }

    /**
     * Met à jour le plat avec gestion d'image
     */
    public function update(Request $request, Plat $plat)
    {
        $validated = $request->validate($this->validationRules());

        // Gestion de la mise à jour de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($plat->image) {
                Storage::disk('public')->delete($plat->image);
            }
            $validated['image'] = $request->file('image')->store('plat', 'public');
        } else {
            unset($validated['image']);
        }

        $plat->update($validated);

        return redirect()->route('admin.plat.show', $plat)
            ->with('success', 'Plat mis à jour avec succès');
    }

    /**
     * Supprime le plat de manière sécurisée
     */
    public function destroy(Plat $plat)
    {
        // Vérifier les commandes associées
        if ($plat->commandes()->exists()) {
            return back()->with('error', 'Impossible de supprimer un plat associé à des commandes');
        }

        // Suppression de l'image
        if ($plat->image) {
            Storage::disk('public')->delete($plat->image);
        }

        $plat->delete();

        return redirect()->route('admin.plat.index')
            ->with('success', 'Plat supprimé avec succès');
    }

    /**
     * Règles de validation réutilisables
     */
    protected function validationRules(): array
    {
        return [
            'menu_categorie_id' => 'required|exists:menu_categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0.1|max:999',
            'image' => 'nullable|image|max:2048',
            'available' => 'required|boolean',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'string|max:100'
        ];
    }
}
