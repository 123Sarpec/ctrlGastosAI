<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfielRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UpdateProfileController extends Controller
{
    public function edit()
    {
        return Inertia::render('Settings/UpdateProfile');
    }

    public function update(UpdateProfielRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
        return back()->with('success', 'Su perfil ha sido actualizado correctamente.');
    }
}
