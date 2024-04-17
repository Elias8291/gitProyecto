<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function showWelcomePage()
    {
        if (Auth::check()) {
            return redirect()->route('home'); // Redirigir a la página de inicio si está autenticado
        } else {
            return view('welcome'); // Mostrar la página de bienvenida si no está autenticado
        }
    }
}
