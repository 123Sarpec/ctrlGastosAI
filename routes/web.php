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


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
     $request->fulfill();
    // Implementation for email verification
})->middleware(['auth', 'signed'])->name('verification.verify');
