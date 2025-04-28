<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function login()
    {
        return view('Auth.login');
    }

    public function accueil()
    {
        return view('Accueil');
    }

    public function restaurant()
    {
        return view('Restaurant');
    }

    public function compte()
    {
        return view('Compte');
    }

    public function reservation()
    {
        return view('Reservation');
    }

    public function admin()
    {
        return view('Admin');
    }
}
