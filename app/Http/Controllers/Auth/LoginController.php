<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\IniciarSesionRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(IniciarSesionRequest $request)
    {
        // Login logic here
        // dd('desde login controller');
        $data = $request->validated();

        if (!Auth::attempt($data, true)) {
            return back()->with('error', 'Credenciales inválidas.');
        }
         
        return redirect()->intended('dashboard');
    }
}
