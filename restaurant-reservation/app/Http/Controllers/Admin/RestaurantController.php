<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RestaurantController extends Controller
{
    /**
     * Affiche la liste des restaurants (version admin)
     */
    public function index()
    {
        $restaurants = Restaurant::withCount(['tables', 'menuCategories', 'reservations'])
            ->latest()
            ->paginate(10);

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Affiche le formulaire de création (admin)
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Enregistre un nouveau restaurant (admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'statut' => 'required|in:actif,inactif',
        ]);

        $restaurant = new Restaurant();
        $restaurant->nom = $validated['nom'];
        $restaurant->adresse = $validated['adresse'];
        $restaurant->telephone = $validated['telephone'];
        $restaurant->email = $validated['email'] ?? null;
        $restaurant->description = $validated['description'] ?? null;
        $restaurant->is_active = $validated['statut'] === 'actif';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
            $restaurant->image = $imagePath;
        }

        $restaurant->save();

        return redirect()->route('admin.restaurants.index')->with('success', 'Restaurant ajouté avec succès.');
    }



    /**
     * Affiche les détails complets d'un restaurant (admin)
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->load([
            'horaire',
            'tables' => fn($query) => $query->withCount('reservations'),
            'menuCategories.plats',
            'reservations' => fn($query) => $query->latest()->limit(5)
        ]);

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Affiche le formulaire d'édition (admin)
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Met à jour le restaurant (admin)
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('restaurants')->ignore($restaurant->id)
            ],
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'statut' => 'required|in:actif,inactif'
        ]);

        // Gestion de la mise à jour de l'image
        if ($request->hasFile('image')) {
            // Suppression de l'ancienne image
            if ($restaurant->image) {
                Storage::disk('public')->delete($restaurant->image);
            }
            $validated['image'] = $request->file('image')->store('restaurants', 'public');
        } else {
            unset($validated['image']);
        }

        $restaurant->update($validated);

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant mis à jour avec succès');
    }

    /**
     * Supprime le restaurant (admin)
     */
    public function destroy(Restaurant $restaurant)
    {
        // Suppression de l'image associée
        if ($restaurant->image) {
            Storage::disk('public')->delete($restaurant->image);
        }

        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant supprimé avec succès');
    }
}
