<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/registro',[RegistroController::class, 'index'])->name('registro');
Route::post('/auth/registro',[RegistroController::class, 'store'])->name('registro.store');


Route::get('/auth/login',[LoginController::class, 'index'])->name('login'); 
Route::post('/auth/login',[LoginController::class, 'store'])->name('login.store');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
     $request->fulfill();

     return redirect()->route('dashboard')->with('success', 'Correo electrónico verificado correctamente.');

    // Implementation for email verification
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/email/verify', function(){
    return view('auth.verficacion');
})->middleware('auth')->name('verification.notice');


Route::get('/dashboard', function () { 
    return view('PPrincipal');
})->middleware(['auth', 'verified'])->name('dashboard'); 