<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Commande;
use App\Models\Livreur;
use App\Enums\LivraisonStatus;
use App\Enums\StatutLivreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class LivraisonController extends Controller
{
    public function index()
    {
        $livraisons = Livraison::query()
            ->with(['commande.client', 'livreur'])
            ->filter(request()->only('status', 'livreur_id', 'date'))
            ->latest('review_start_time')
            ->paginate(10)
            ->withQueryString();

        return view('admin.livraisons.index', [
            'livraisons' => $livraisons,
            'statuses' => LivraisonStatus::cases(),
            'livreurs' => Livreur::actifs()->get()
        ]);
    }

    public function create()
    {
        return view('admin.livraisons.create', [
            'commandes' => Commande::disponiblePourLivraison()->get(),
            'livreurs' => Livreur::disponible()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());
        
        return DB::transaction(function () use ($validated) {
            $livraison = Livraison::create($validated);
            
            // Vérification explicite
            if ($livraison->livreur instanceof Livreur) {
                $this->updateLivreurDisponibilite($livraison->livreur, false);
            } else {
                abort(500, "Le livreur associé n'est pas valide.");
            }
            
            return redirect()->route('admin.livraisons.show', $livraison)
                ->with('success', __('Livraison planifiée avec succès'));
        
        });
    }

    public function show(Livraison $livraison)
    {
        $livraison->load([
            'commande.lignesCommande.plat',
            'livreur',
            'retards'
        ]);

        return view('admin.livraisons.show', compact('livraison'));
    }

    public function edit(Livraison $livraison)
    {
        return view('admin.livraisons.edit', [
            'livraison' => $livraison,
            'commandes' => Commande::disponiblePourLivraison()
                ->orWhere('id', $livraison->commande_id)
                ->get(),
            'livreurs' => Livreur::where(function($query) use ($livraison) {
                $query->disponible()
                    ->orWhere('id', $livraison->livreur_id);
            })->get()
        ]);
    }

    public function update(Request $request, Livraison $livraison)
    {
        $validated = $request->validate($this->validationRules($livraison));
    
        return DB::transaction(function () use ($validated, $livraison) {
            $ancienLivreur = $livraison->livreur;
            $nouveauLivreur = Livreur::findOrFail($validated['livreur_id']);

            if ($ancienLivreur && $ancienLivreur->isNot($nouveauLivreur )) {
                $this->updateLivreurDisponibilite($ancienLivreur, true);
                $this->updateLivreurDisponibilite($nouveauLivreur, false);
            }

            $livraison->update($validated);
    
            return redirect()->route('admin.livraisons.show', $livraison)
                ->with('success', __('Livraison mise à jour avec succès'));
        });
    }

    public function destroy(Livraison $livraison)
    {
        abort_if(Gate::denies('delete-livraisons'), 403);

        return DB::transaction(function () use ($livraison) {
            if ($livraison->livreur) {
                $this->updateLivreurDisponibilite($livraison->livreur, true);
            }
            
            $livraison->delete();

            return redirect()->route('admin.livraisons.index')
                ->with('success', __('Livraison annulée avec succès'));
        });
    }

    protected function validationRules(?Livraison $livraison = null): array
    {
        return [
            'commande_id' => [
                'required',
                'exists:commandes,id',
                Rule::unique('livraisons')->ignore($livraison)
            ],
            'livreur_id' => [
                'required',
                'exists:livreurs,id',
                function ($attribute, $value, $fail) {
                    $livreur = Livreur::find($value);
                    if (!$livreur?->estDisponible()) {
                        $fail(__('Livreur non disponible'));
                    }
                }
            ],
            'address' => 'required|string|max:255',
            'status' => 'required|in:' . implode(',', array_column(LivraisonStatus::cases(), 'value')),
            'review_start_time' => 'required|date|after_or_equal:now',
            'estimated_arrival_time' => 'required|date|after:review_start_time',
            'notes' => 'nullable|string|max:500'
        ];
    }

    private function updateLivreurDisponibilite(Livreur $livreur, bool $disponible): void
    {
        $statut = $disponible ? StatutLivreur::DISPONIBLE : StatutLivreur::OCCUPE;
        
        $livreur->update([
            'statut' => $statut->value,
            'disponible_jusqu' => $disponible ? null : Carbon::now()->addHours(8)
        ]);
    }
}