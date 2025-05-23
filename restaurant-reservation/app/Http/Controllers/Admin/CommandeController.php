<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Reservation;
use App\Enums\CommandeStatus;
use App\Enums\PaymentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Models\Restaurant;

class CommandeController extends Controller
{
    /**
     * Affiche la liste des commandes avec filtres
     */
    public function index()
    {
        $commandes = Commande::query()
            ->with(['client', 'reservation.table.restaurant'])
            ->filter(request()->only('status', 'restaurant_id', 'date'))
            ->latest('date_time')
            ->paginate(10)
            ->withQueryString();

        return view('admin.commande.index', [
            'commandes' => $commandes,
            'statuses' => CommandeStatus::cases(),
            'restaurants' => Restaurant::pluck('nom', 'id')
        ]);
    }

    public function create()
    {
        return view('admin.commande.create', [
            'clients' => Client::active()->get(),
            'reservations' => Reservation::disponible()->get(),
            'modes_paiement' => PaymentMode::cases()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $commande = Commande::create($validated);
        $this->updateCommandeStatus($commande);

        return redirect()->route('admin.commande.show', $commande)
            ->with('success', __('Commande créée avec succès'));
    }

    public function show(Commande $commande)
    {
        $commande->load([
            'lignesCommande.plat.menuCategorie',
            'paiement',
            'livraison.livreur',
            'reservation.table.restaurant'
        ]);

        return view('admin.commande.show', compact('commande'));
    }

    public function edit(Commande $commande)
    {
        return view('admin.commande.edit', [
            'commande' => $commande,
            'clients' => Client::active()->get(),
            'reservations' => Reservation::disponible()->orWhere('id', $commande->reservation_id)->get(),
            'modes_paiement' => PaymentMode::cases()
        ]);
    }

    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate($this->validationRules($commande));

        $commande->update($validated);
        $this->updateCommandeStatus($commande, true);

        return redirect()->route('admin.commande.show', $commande)
            ->with('success', __('Commande mise à jour avec succès'));
    }

    public function destroy(Commande $commande)
    {
        abort_if(Gate::denies('delete-commandes'), 403);

        if ($commande->canBeDeleted()) {
            $commande->deleteWithRelations();
            return redirect()->route('admin.commande.index')
                ->with('success', __('Commande archivée avec succès'));
        }

        return redirect()->back()
            ->with('error', __('Impossible de supprimer cette commande'));
    }

    protected function validationRules(?Commande $commande = null): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'reservation_id' => [
                'nullable',
                'exists:reservations,id',
                Rule::unique('commandes')->ignore($commande)
            ],
            'date_time' => 'required|date|after_or_equal:now',
            'status' => 'required|in:' . implode(',', CommandeStatus::values()),
            'total_amount' => 'required|numeric|min:0|max:9999',
            'payment_mode' => 'required|in:' . implode(',', PaymentMode::values()),
            'is_delivery' => 'required|boolean',
            'delivery_address' => 'required_if:is_delivery,true|max:255',
            'notes' => 'nullable|string|max:500'
        ];
    }

    private function updateCommandeStatus(Commande $commande, bool $isUpdate = false): void
    {
        if ($commande->reservation_id && !$isUpdate) {
            $commande->update(['status' => CommandeStatus::EN_ATTENTE]);
        }

        if ($commande->wasChanged('status')) {
            $commande->notifyStatusChange();
        }
    }
}
