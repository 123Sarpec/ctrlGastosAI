<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.ForgotPassword');
    }
    public function store(ForgotPasswordRequest $request)
    {
        // dd('desde store');
        Password::sendResetLink([
            'email' => $request->email
        ]);
        return back()->with('success', 'Se ha enviado un correo electrónico para restablecer la contraseña.');
    }
}
