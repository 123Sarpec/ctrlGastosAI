<?php

use App\Ai\Tools\AddExpenses;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\CerraSesionController;
use App\Http\Controllers\CerraSesionController;
use App\Http\Controllers\ExpenseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\PresupuestoChatController;
use App\Http\Controllers\AddTicketController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SuscripcionChekout;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\UpdateProfileController;
use Inertia\Inertia;

// use App\Http\Controllers\ExpenseController;


Route::get('/', function () {
    return view('home');
})->name('Home');


Route::get('/auth/registro', [RegistroController::class, 'index'])->name('registro');
Route::post('/auth/registro', [RegistroController::class, 'store'])->name('registro.store');


Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth/login', [LoginController::class, 'store'])->name('login.store');


/*cerrar sesion*/
Route::post('/auth/logout', [CerraSesionController::class, 'store'])->name('logout.store');

/*olvida contrase;a*/
Route::get('/auth/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
Route::get('/auth/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('/auth/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');


// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//      $request->fulfill();

//      return redirect()->route('dashboard')->with('success', 'Correo electrónico verificado correctamente.');

//     // Implementation for email verification
// })->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {

    $user = User::findOrFail($id);

    // Validar que el hash pertenece al correo del usuario
    if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        abort(403, 'Enlace de verificación inválido');
    }

    // Verificar correo
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    // Opcional: iniciar sesión con el usuario verificado
    Auth::login($user);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Correo electrónico verificado correctamente.');
})->middleware('signed')->name('verification.verify');


Route::get('/email/verify', function () {
    return view('auth.verficacion');
})->middleware('auth')->name('verification.notice');


Route::post('/email/verificacion-notificacion', function (Request $request) {
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
    Route::post('/Presupuestos/crear', [PresupuestoController::class, 'store'])->name('Presupuestos.store');

    Route::get('/Presupuestos/{presupuesto}/edit', [PresupuestoController::class, 'edit'])->name('Presupuestos.edit');
    Route::get('/Presupuestos/{presupuesto}/edit', [PresupuestoController::class, 'edit'])->name('Presupuestos.edit');

    Route::get('/Presupuestos/{presupuesto}/show', [PresupuestoController::class, 'show'])->name('Presupuestos.show');

    Route::put('/Presupuestos/{presupuesto}', [PresupuestoController::class, 'update'])->name('Presupuestos.update');
    Route::delete('/Presupuestos/{presupuesto}', [PresupuestoController::class, 'destroy'])->name('Presupuestos.destroy');


    /*gasto*/
    Route::post('/Presupuestos/{presupuesto}/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::put('/Presupuestos/{presupuesto}/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/Presupuestos/{presupuesto}/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    // Route::post('/Presupuestos/{presupuesto}/chat', [PresupuestoChatController::class, 'store'])->name('Presupuestos.chat');
    // Route::post('/Presupuestos/{presupuesto}/addimage', [AddTicketController::class, 'store'])->name('Presupuestos.addimage');

    Route::get('/settings/profile', [UpdateProfileController::class, 'edit'])->name('settings.profile');
    Route::put('/settings/profile', [UpdateProfileController::class, 'update'])->name('settings.profile.update');
    Route::get('/settings/password', [UpdatePasswordController::class, 'edit'])->name('settings.password');
    Route::put('/settings/password', [UpdatePasswordController::class, 'update'])->name('settings.password.update');



    Route::middleware(['auth', 'verified', 'suscribed'])->group(function () {
        Route::post('/Presupuestos/{presupuesto}/chat', [PresupuestoChatController::class, 'store'])->name('Presupuestos.chat');
        Route::post('/Presupuestos/{presupuesto}/addimage', [AddTicketController::class, 'store'])->name('Presupuestos.addimage');
    });
});



Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('/subscription.checkout/{plan}', [SuscripcionChekout::class, 'store'])->name('subscription.checkout')->whereIn('plan', ['monthly', 'yearly']);

    Route::view('/billing/success', 'billing.success')->name('billing.success');
    Route::view('/billing/cancel', 'billing.cancel')->name('billing.cancel');
});
Route::get('/plans', function () {
    return Inertia::render('Proo/Plans');
})->name('plans');



Route::get('/subscription', [SuscripcionController::class, 'show'])
    ->name('subscription.manage');

Route::post('/subscription/swap/{plan}', [SuscripcionController::class, 'swap'])
    ->name('subscription.swap')
    ->whereIn('plan', ['monthly', 'yearly']);

Route::post('/subscription/cancel', [SuscripcionController::class, 'cancel'])
    ->name('subscription.cancel');

Route::post('/subscription/resume', [SuscripcionController::class, 'resume'])
    ->name('subscription.resume');

Route::get('/billing', function (Request $request) {
    return $request->user()->redirectToBillingPortal(route('dashboard'));
})->name('billing');
