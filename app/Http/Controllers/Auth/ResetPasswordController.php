<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function index(string $token, Request $request)
    {
        // dd($request->email);
        return view('auth.ResetPassword', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function store(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $status = Password::reset(
            $data,
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('login')
                ->with('status', 'Tu contraseña ha sido restablecida correctamente.');
        }

        return back()
            ->withErrors([
                'token' => 'El enlace ha expirado o no es válido. Por favor, solicita uno nuevo.',
            ]);
    }
}
