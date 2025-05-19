<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategorie;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class MenuCategoriesController extends Controller
{
    /**
     * Affiche la liste des catégories avec recherche et tri
     */
    public function index()
    {
    $categories = MenuCategorie::query()
        ->with(['restaurant', 'plats'])
        ->withCount('plats')
        ->filter(request()->only('search', 'restaurant_id')) // si filtre actif
        ->orderBy('nom')
        ->paginate(10)
        ->withQueryString();

        $restaurants = Restaurant::pluck('nom', 'id');

        return view('admin.menu-categories.index', compact('categories', 'restaurants'));
    }

    /**
     * Affiche le formulaire de création avec sélection de restaurant
     */
    public function create()
    {
        return view('admin.menu-categories.create', [
            'restaurants' => Restaurant::active()->get()
        ]);
    }

    /**
     * Enregistre une nouvelle catégorie
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $categorie = MenuCategorie::create($validated);

        return redirect()->route('admin.menu-categories.index', $categorie)
            ->with('success', __('Catégorie créée avec succès'));
    }

    /**
     * Affiche les détails avec statistiques
     */
    public function show(MenuCategorie $menuCategorie)
    {
        $menuCategorie->load([
            'plats' => fn($q) => $q->withCount('commandes'),
            'restaurant'
        ]);

        return view('admin.menu-categories.show', compact('menuCategorie'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(MenuCategorie $menuCategorie)
    {
        return view('admin.menu-categories.edit', [
            'categorie' => $menuCategorie,
            'restaurants' => Restaurant::active()->get()
        ]);
    }

    /**
     * Met à jour la catégorie
     */
    public function update(Request $request, MenuCategorie $menuCategorie)
    {
        $validated = $request->validate($this->validationRules($menuCategorie));

        $menuCategorie->update($validated);

        return redirect()->route('admin.menu-categories.show', $menuCategorie)
            ->with('success', __('Catégorie mise à jour avec succès'));
    }

    /**
     * Supprime une catégorie après vérifications
     */
    public function destroy(MenuCategorie $menuCategorie)
    {
        abort_if(Gate::denies('delete-categorie'), 403);

        if ($menuCategorie->plats()->exists()) {
            return back()->with('error', __('Impossible de supprimer une catégorie contenant des plats actifs.'));
        }

        $menuCategorie->delete();

        return redirect()->route('admin.menu-categories.index')
            ->with('success', __('Catégorie supprimée avec succès'));
    }

    /**
     * Règles de validation réutilisables
     */
    protected function validationRules(MenuCategorie $categorie = null): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menu_categories')
                    ->where('restaurant_id', request('restaurant_id'))
                    ->ignore($categorie)
            ],
            'description' => 'nullable|string|max:500',
            'ordre_affichage' => 'sometimes|integer|min:1'
        ];
    }
}
