<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectAfterLogin();
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    // Afficher le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Traiter l'inscription avec transaction
    public function register(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => ['required', 'confirmed', Password::min(8)],
                'telephone' => 'nullable|string|max:20', // Corrigé en nullable
                'type' => 'required|in:client,admin' // Corrigé pour correspondre à la migration
            ]);

            // Création de l'utilisateur
            $user = User::create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'telephone' => $data['telephone'],
                'type' => $data['type'],
                'isActive' => true,
                'InscriptionDate' => now()
            ]);

            // Création du profil spécifique
            if ($data['type'] === 'client') {
                $user->client()->create(['points_fidelite' => 0]);
            } else {
                $user->admin()->create(['role' => 'basic']); // Nom de méthode cohérent
            }

            Auth::login($user);
            return $this->redirectAfterLogin();
        });
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Redirection après authentification
    protected function redirectAfterLogin()
    {
        return auth()->user()->isAdmin() 
            ? redirect()->route('admin.dashboard')
            : redirect()->route('client.dashboard');
    }
}