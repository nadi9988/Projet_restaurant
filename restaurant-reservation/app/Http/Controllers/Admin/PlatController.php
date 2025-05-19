<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategorie;
use App\Models\Plat;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PlatController extends Controller
{
    public function index(Request $request)
    {
        $plats = Plat::with(['menuCategorie', 'menuCategorie.restaurant'])
            ->when($request->search, function ($query, $search) {
                $query->where('nom', 'like', '%' . $search . '%');
            })
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        // ✅ On récupère les catégories pour la vue
        $categories = MenuCategorie::with('restaurant')->get();

        return view('admin.plat.index', compact('plats', 'categories'));
    }

    public function create()
    {
        return view('admin.plat.create', [
            'categories' => MenuCategorie::with('restaurant')->get(),
            'restaurants' => Restaurant::active()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'menu_categories_id' => 'required|exists:menu_categories,id',
            'prix' => 'required|numeric|min:0',
            'disponible' => 'required|boolean',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/plats', 'public');
            $validated['image'] = basename($path);
        }

        Plat::create($validated);

        return redirect()->route('admin.plat.index')->with('success', 'Plat ajouté avec succès.');
    }

    public function show(Plat $plat)
    {
        $plat->load(['menuCategorie.restaurant']);

        return view('admin.plat.show', compact('plat'));
    }

    public function edit(Plat $plat)
    {
        return view('admin.plat.edit', [
            'plat' => $plat,
            'categories' => MenuCategorie::with('restaurant')->get(),
            'restaurants' => Restaurant::active()->get(),
        ]);
    }

    public function update(Request $request, Plat $plat)
    {
        $validated = $request->validate($this->validationRules($plat));

        // Gestion de l'image
        if ($request->hasFile('image')) {
            if ($plat->image) {
                Storage::disk('public')->delete('images/plats/' . $plat->image);
            }
            $path = $request->file('image')->store('images/plats', 'public');
            $validated['image'] = basename($path);
        }

        $plat->update($validated);

        return redirect()->route('admin.plat.show', $plat)
            ->with('success', 'Plat mis à jour avec succès.');
    }

    public function destroy(Plat $plat)
    {
        abort_if(Gate::denies('delete-plat'), 403);

        if ($plat->image) {
            Storage::disk('public')->delete('images/plats/' . $plat->image);
        }

        $plat->delete();

        return redirect()->route('admin.plat.index')
            ->with('success', 'Plat supprimé avec succès.');
    }

    protected function validationRules(Plat $plat = null): array
    {
        return [
            'menu_categories_id' => ['required', 'exists:menu_categories,id'],
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('plats')
                    ->where(fn ($query) => $query->where('menu_categories_id', request('menu_categories_id')))
                    ->ignore($plat),
            ],
            'description' => ['nullable', 'string', 'max:500'],
            'prix' => ['required', 'numeric', 'min:0'],
            'disponible' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
