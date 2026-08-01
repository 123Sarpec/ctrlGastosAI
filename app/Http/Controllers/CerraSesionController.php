<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CerraSesionController extends Controller
{
    //
    public function store(Request $request)
    {
        // Cerrar sesión del usuario
        // auth()->logout();
        Auth::logout();

        // Redirigir al usuario a la página de inicio de sesión u otra página deseada
        return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
    }
}
