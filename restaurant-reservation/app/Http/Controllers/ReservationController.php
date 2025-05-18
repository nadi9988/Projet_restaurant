<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    /**
     * Affiche la liste des réservations
     */
    public function index()
    {
        $reservations = Reservation::with(['client', 'restaurant', 'table'])
            ->orderBy('date_time', 'desc')
            ->paginate(10);

        return view('Reservation', compact('reservations'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $clients = Client::all();
        $restaurants = Restaurant::all();
        $tables = Table::where('available', true)->get();

        return view('Reservation.create', compact('clients', 'restaurants', 'tables'));
    }

    /**
     * Enregistre une nouvelle réservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_id' => [
                'required',
                'exists:tables,id',
                function ($attribute, $value, $fail) use ($request) {
                    $table = Table::find($value);
                    if ($table->capacity < $request->number_of_people) {
                        $fail('La capacité de la table est insuffisante');
                    }
                }
            ],
            'date_time' => [
                'required',
                'date',
                'after_or_equal:' . now()->addHours(2)
            ],
            'number_of_people' => 'required|integer|min:1',
            'status' => 'required|in:confirmée,en attente,annulée,terminée',
            'comments' => 'nullable|string|max:500',
            'order_pre_dishes' => 'nullable|string'
        ]);

        // Vérification de la disponibilité de la table
        $existingReservation = Reservation::where('table_id', $validated['table_id'])
            ->where('date_time', '>=', Carbon::parse($validated['date_time'])->subHour())
            ->where('date_time', '<=', Carbon::parse($validated['date_time'])->addHour())
            ->exists();

        if ($existingReservation) {
            return back()->withErrors(['table_id' => 'La table est déjà réservée pour cette plage horaire'])->withInput();
        }

        Reservation::create($validated);

        return redirect()->route('Reservation')
            ->with('success', 'Réservation créée avec succès');
    }

    /**
     * Affiche les détails d'une réservation
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['client', 'restaurant', 'table', 'commande']);
        return view('Reservation.show', compact('reservation'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Reservation $reservation)
    {
        $clients = Client::all();
        $restaurants = Restaurant::all();
        $tables = Table::where('available', true)->get();

        return view('reservation.edit', compact('reservation', 'clients', 'restaurants', 'tables'));
    }

    /**
     * Met à jour la réservation
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_id' => [
                'required',
                'exists:tables,id',
                function ($attribute, $value, $fail) use ($request) {
                    $table = Table::find($value);
                    if ($table->capacity < $request->number_of_people) {
                        $fail('La capacité de la table est insuffisante');
                    }
                }
            ],
            'date_time' => [
                'required',
                'date',
                'after_or_equal:' . now()->addHour()
            ],
            'number_of_people' => 'required|integer|min:1',
            'status' => 'required|in:confirmée,en attente,annulée,terminée',
            'comments' => 'nullable|string|max:500',
            'order_pre_dishes' => 'nullable|string'
        ]);

        // Vérification de conflit de réservation (en excluant la réservation actuelle)
        $existingReservation = Reservation::where('table_id', $validated['table_id'])
            ->where('id', '!=', $reservation->id)
            ->whereBetween('date_time', [
                Carbon::parse($validated['date_time'])->subHour(),
                Carbon::parse($validated['date_time'])->addHour()
            ])
            ->exists();

        if ($existingReservation) {
            return back()->withErrors(['table_id' => 'La table est déjà réservée pour cette plage horaire'])->withInput();
        }

        $reservation->update($validated);

        return redirect()->route('Reservation')
            ->with('success', 'Réservation mise à jour avec succès');
    }

    /**
     * Supprime la réservation
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('Reservation')
            ->with('success', 'Réservation supprimée avec succès');
    }
}