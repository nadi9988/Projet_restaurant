<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TableController extends Controller
{
    /**
     * Affiche la liste des tables avec filtres
     */
    public function index()
    {
        $tables = Table::query()
            ->with(['restaurant', 'reservations'])
            ->withCount('reservations')
            ->filter(request()->only('restaurant_id', 'capacity', 'available'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $restaurants = Restaurant::active()->pluck('name', 'id');

        return view('admin.tables.index', compact('tables', 'restaurants'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.tables.create', [
            'restaurants' => Restaurant::active()->get(),
            'locations' => config('tables.locations')
        ]);
    }

    /**
     * Enregistre une nouvelle table
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        Table::create($validated + ['qr_code' => $this->generateQrCode()]);

        return redirect()->route('admin.tables.index')
            ->with('success', __('Table created successfully'));
    }

    /**
     * Affiche les détails de la table
     */
    public function show(Table $table)
    {
        $table->load([
            'reservations' => fn($q) => $q->latest()->with('user'),
            'restaurant'
        ]);

        return view('admin.tables.show', compact('table'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Table $table)
    {
        return view('admin.tables.edit', [
            'table' => $table,
            'restaurants' => Restaurant::active()->get(),
            'locations' => config('tables.locations')
        ]);
    }

    /**
     * Met à jour la table
     */
    public function update(Request $request, Table $table)
    {
        $validated = $request->validate($this->validationRules($table));

        $table->update($validated);

        return redirect()->route('admin.tables.show', $table)
            ->with('success', __('Table updated successfully'));
    }

    /**
     * Supprime la table
     */
    public function destroy(Table $table)
    {
        abort_if(Gate::denies('delete-tables'), 403);

        if($table->reservations()->exists()) {
            return back()->with('error', __('Cannot delete table with reservations'));
        }

        Storage::disk('public')->delete($table->qr_code);
        $table->delete();

        return redirect()->route('admin.tables.index')
            ->with('success', __('Table deleted successfully'));
    }

    /**
     * Règles de validation réutilisables
     */
    protected function validationRules(?Table $table = null): array
    {
        return [
            'restaurant_id' => [
                'required',
                'exists:restaurants,id',
                Rule::exists('restaurants', 'id')->where('active', true)
            ],
            'numero' => [
                'required',
                'integer',
                Rule::unique('tables')
                    ->where('restaurant_id', request('restaurant_id'))
                    ->ignore($table)
            ],
            'capacity' => 'required|integer|min:1|max:20',
            'available' => 'required|boolean',
            'location' => [
                'required',
                Rule::in(array_keys(config('tables.locations')))
            ],
            'description' => 'nullable|string|max:255'
        ];
    }

    /**
     * Génère un QR code unique
     */
    //private function generateQrCode(): string
    //{
        //$qrCode = uniqid('table_').time();
        //Storage::disk('public')->put("qrcodes/$qrCode.svg", generateQrSvg($qrCode));
        
        //return "qrcodes/$qrCode.svg";
    //}
}
