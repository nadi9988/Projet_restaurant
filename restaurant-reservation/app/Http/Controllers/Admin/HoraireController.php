<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horaire;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HoraireController extends Controller
{
    public function index()
    {
        $horaires = Horaire::with('restaurant')
            ->orderBy('restaurant_id')
            ->paginate(10);

        return view('admin.horaire.index', compact('horaires'));
    }

    public function create()
    {
        $restaurants = Restaurant::doesntHave('horaire')->get();
        return view('admin.horaire.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => [
                'required',
                'exists:restaurants,id',
                Rule::unique('horaires', 'restaurant_id')
            ],
            'opening_time' => 'required|array',
            'exceptional_days' => 'nullable|array'
        ]);

        $validated['opening_time'] = $this->formatSchedule($validated['opening_time']);
        
        Horaire::create($validated);

        return redirect()->route('admin.horaire.index')
            ->with('success', 'Horaire enregistré avec succès');
    }

    public function edit(Horaire $horaire)
    {
        return view('admin.horaire.edit', compact('horaire'));
    }

    public function update(Request $request, Horaire $horaire)
    {
        $validated = $request->validate([
            'opening_time' => 'required|array',
            'exceptional_days' => 'nullable|array'
        ]);

        $validated['opening_time'] = $this->formatSchedule($validated['opening_time']);
        $horaire->update($validated);

        return redirect()->route('admin.horaire.index')
            ->with('success', 'Horaire mis à jour avec succès');
    }

    public function destroy(Horaire $horaire)
    {
        $horaire->delete();
        return redirect()->route('admin.horaire.index')
            ->with('success', 'Horaire supprimé avec succès');
    }

    private function formatSchedule(array $schedule): array
    {
        $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
        $formatted = [];

        foreach ($days as $day) {
            $formatted[$day] = [
                'ouverture' => $schedule[$day]['ouverture'] ?? null,
                'fermeture' => $schedule[$day]['fermeture'] ?? null,
                'fermé' => $schedule[$day]['fermé'] ?? false
            ];
        }

        return $formatted;
    }
}
