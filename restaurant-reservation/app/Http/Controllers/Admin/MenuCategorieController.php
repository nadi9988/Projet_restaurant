<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategorie;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class MenuCategorieController extends Controller
{
    /**
     * Affiche la liste des catégories avec recherche et tri
     */
    public function index()
    {
        $categories = MenuCategorie::query()
            ->with(['restaurant', 'plats'])
            ->withCount('plats')
            ->filter(request()->only('search', 'restaurant_id'))  // <-- utilise le scope filter
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $restaurants = Restaurant::pluck('name', 'id');

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
     * Enregistre une nouvelle catégorie avec gestion d'image
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $categorie = MenuCategorie::create($validated);

        return redirect()->route('admin.menu-categories.show', $categorie)
            ->with('success', __('Category created successfully'));
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
     * Affiche le formulaire d'édition avec historique
     */
    public function edit(MenuCategorie $menuCategorie)
    {
        return view('admin.menu-categories.edit', [
            'categorie' => $menuCategorie,
            'restaurants' => Restaurant::active()->get()
        ]);
    }

    /**
     * Met à jour la catégorie avec audit
     */
    public function update(Request $request, MenuCategorie $menuCategorie)
    {
        $validated = $request->validate($this->validationRules($menuCategorie));

        $menuCategorie->update($validated);

        return redirect()->route('admin.menu-categories.show', $menuCategorie)
            ->with('success', __('Category updated successfully'));
    }

    /**
     * Suppression sécurisée avec archivage
     */
    public function destroy(MenuCategorie $menuCategorie)
    {
        abort_if(Gate::denies('delete-categorie'), 403);

        if ($menuCategorie->plats()->exists()) {
            return back()->with('error', __('Cannot delete category with active dishes'));
        }

        $menuCategorie->delete();

        return redirect()->route('admin.menu-categories.index')
            ->with('success', __('Category archived successfully'));
    }

    /**
     * Règles de validation réutilisables
     */
    protected function validationRules(MenuCategorie $categorie = null): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => [
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
