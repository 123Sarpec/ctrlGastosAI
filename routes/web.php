<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\CerraSesionController;
use App\Http\Controllers\CerraSesionController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\PresupuestoController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/registro',[RegistroController::class, 'index'])->name('registro');
Route::post('/auth/registro',[RegistroController::class, 'store'])->name('registro.store');


Route::get('/auth/login',[LoginController::class, 'index'])->name('login'); 
Route::post('/auth/login',[LoginController::class, 'store'])->name('login.store');


/*cerrar sesion*/
Route::post('/auth/logout', [CerraSesionController::class, 'store'])->name('logout.store');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
     $request->fulfill();

     return redirect()->route('dashboard')->with('success', 'Correo electrónico verificado correctamente.');

    // Implementation for email verification
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/email/verify', function(){
    return view('auth.verficacion');
})->middleware('auth')->name('verification.notice');


Route::post('/email/verificacion-notificacion', function(Request $request) {
    // return view('auth.verficacion');
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Se ha enviado un nuevo enlace de verificación a tu correo electrónico.');
})->middleware('auth', 'throttle:1,1')->name('verification.send'); //cantidad de peticiones por minuto, en este caso 1 por minuto



// Route::get('/dashboard', function () { 
//     return view('PPrincipal');
// })->middleware(['auth', 'verified'])->name('dashboard'); 


Route::prefix('dashboard')->group(function () {
        Route::get('/', [PresupuestoController::class, 'index'])->name('dashboard'); 
        Route::get('/Presupuestos/crear', [PresupuestoController::class, 'create'])->name('Presupuestos.create'); 
}); 