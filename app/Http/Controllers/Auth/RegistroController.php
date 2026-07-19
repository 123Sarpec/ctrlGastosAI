<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CrearcuentaRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    // -------------/*funcion del archivo principal*/-----------
    public function index()
    {
        return view('auth.registro');
    }

    /*crear cuenta de usuario*/
    public function store(CrearcuentaRequest $request)
    {
        // Validar los datos del formulario
        //  $name = $request->input('name'); 
        //  return "me llamo wilmer: $name";

         $data = $request->validated();

        //  dd($data); // Aquí puedes realizar la lógica para crear el usuario en la base de datos

         $user = User::create($data);

         //enviar email de verificacion
         event(new Registered($user));

         Auth::login($user);

         return redirect()->route('verification.notice');

    }
}
