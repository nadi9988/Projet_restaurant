<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Affiche la liste des administrateurs
     */
    public function index()
    {
        $admins = Admin::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admins.index', compact('admins'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $users = User::doesntHave('admin')->get();
        $roles = ['superadmin', 'manager', 'support'];

        return view('admins.create', compact('users', 'roles'));
    }

    /**
     * Enregistre un nouvel administrateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('admins', 'user_id')
            ],
            'role' => 'required|in:superadmin,manager,support'
        ]);

        Admin::create($validated);

        return redirect()->route('admins.index')
            ->with('success', 'Administrateur créé avec succès');
    }

    /**
     * Affiche les détails d'un administrateur
     */
    public function show(Admin $admin)
    {
        $admin->load('user');
        return view('admins.show', compact('admin'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Admin $admin)
    {
        $users = User::whereDoesntHave('admin')
            ->orWhere('id', $admin->user_id)
            ->get();

        $roles = ['superadmin', 'manager', 'support'];

        return view('admins.edit', compact('admin', 'users', 'roles'));
    }

    /**
     * Met à jour l'administrateur
     */
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('admins', 'user_id')->ignore($admin->id)
            ],
            'role' => 'required|in:superadmin,manager,support'
        ]);

        $admin->update($validated);

        return redirect()->route('admins.index')
            ->with('success', 'Administrateur mis à jour avec succès');
    }

    /**
     * Supprime l'administrateur
     */
    public function destroy(Admin $admin)
    {
        // Empêche la suppression du dernier superadmin
        if ($admin->role === 'superadmin' && Admin::where('role', 'superadmin')->count() < 2) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer le dernier superadmin');
        }

        $admin->delete();
        return redirect()->route('admins.index')
            ->with('success', 'Administrateur supprimé avec succès');
    }
}