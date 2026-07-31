<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Events\Registro;
use Illuminate\Support\Facades\Event;

it('should return a successful response', function () {
    $response = $this->get(route('registro'));
    // add($response);
    $response()->assertOk();
    $response()->status(200);
    $response()->assertSee('Crear cuenta');

});
 

// it('should register a new user', function () {

//  Event::fake();
//     $response = $this->post(route('registro.store'), [
//         'name' => 'John Doe',
//         'email' => 'correo5@correo.com',
//         'password' => 'password',
//         'password_confirmation' => 'password',
//     ]);
//  $response->assertRedirect(route('verification.notice'));

//  $user = User::where('email', 'correo5@correo.com')->first();

//  expect($user)->not()->toBeNull();
//  expect($user->name)->toBe('John Doe');
//  expect($user->email)->toBe('john.doe@example.com');
//  expect($user->hasVerifiedEmail())->toBeFalse();

//  Event::assertDispatched(Registro::class);
// });

it('should validate required fields when the request body is empty', function () {
        
    $response = $this->post(route('registro.store'), []);

    $response->assertSessionHasErrors(['name', 'email', 'password']);

    $response->assertSessionHasErrors([
        'name' => 'El nombre es requerido.',
        'email' => 'El correo electrónico es requerido.',
        'password' => 'La contraseña es requerida.',
    ]);
});
