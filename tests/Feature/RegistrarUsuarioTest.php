<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerificacionEmail;
use Illuminate\Support\Facades\URL;
uses(RefreshDatabase::class);

it('should return a successful response', function () {
    $response = $this->get(route('registro'));
    // add($response);
    // $response()->assertOk();
    $response->assertOk();
    // $response->status(200);
    $response->assertSee('Crear Cuenta');

}); 
  

it('should register a new user', function () {

 Event::fake();
    $response = $this->post(route('registro.store'), [
        'name' => 'Wilmer sarpec',
        'email' => 'wilmer@example.com',
        'password' => '$Elian2025',
        'password_confirmation' => '$Elian2025',
    ]);
 $response->assertRedirect(route('verification.notice'));

 $user = User::where('email', 'wilmer@example.com')->first();

 expect($user)->not()->toBeNull();
 expect($user->name)->toBe('Wilmer sarpec');
 expect($user->email)->toBe('wilmer@example.com');
 expect($user->hasVerifiedEmail())->toBeFalse();

 Event::assertDispatched(Registered::class);
});

/*confirmar el correo que no esta vacio*/
it('should validate required fields when the request body is empty', function () {
        
    $response = $this->post(route('registro.store'), []);

    $response->assertSessionHasErrors(
        ['name',
        'email', 
        'password'
        ]);

    $response->assertSessionHasErrors([
        'name' => 'El campo nombre es obligatorio.',
        'email' => 'El campo correo electrónico es obligatorio.',
        'password' => 'El campo contraseña es obligatorio.',
    ]);
            //     'name.required' => 'El campo nombre es obligatorio.',
            // 'email.required' => 'El campo correo electrónico es obligatorio.',
            // 'email.email' => 'El correo electrónico debe tener un formato válido.',
            // 'email.unique' => 'El correo electrónico ya está registrado.',
                        // 'password.required' => 'El campo contraseña es obligatorio.',

});

/*evitar que se registre un usuario con correo duplicado*/
it ('privates duplicate email', function () {

        User::factory()->create([
            'email' => 'wilmer@example.com'
        ]);
        $response = $this->post(route('registro.store'), [
        'name' => 'Wilmer sarpec',
        'email' => 'wilmer@example.com',
        'password' => '$Elian2025',
        'password_confirmation' => '$Elian2025',
    ]);
    $response->assertRedirect();
    $response->assertSessionHasErrors([
        'email' => 'El correo electrónico ya está registrado.'
    ]);
});

/*verificar email que se confirmo */
it('should verify email after registration', function () {

    Notification::fake(); 
        $response = $this->post(route('registro.store'), [
            'name' => 'Wilmer sarpec',
            'email' => 'wilmer@example.com',
            'password' => '$Elian2025',
            'password_confirmation' => '$Elian2025',
        ]);

        $user = User::where('email', 'wilmer@example.com')->first();

    Notification::assertSentTo($user, VerificacionEmail::class);
});

/*verificar que el correo se envio y se verifico el link*/
it('should send verification email and verify the link', function () {

    $user = User::factory()->unverified()->create();

            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                [
                    'id' => $user->id,
                    'hash' => sha1($user->email),
                ]
            );
            $response = $this->actingAs($user)->get($verificationUrl); 

            $response->assertRedirect(route('dashboard'));

            expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});

/*Usuairo no verificado se diriga la pagina principal de dashboard*/
it('should allow access to dashboard only if email is verified', function () {
    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));
    // $response->assertStatus(403);
    $response->assertRedirect(route('verification.notice'));
});

/** Usuario  verificodo con acceso */

it('should allow a verified user to access the dashboard', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));
    // $response->assertStatus(200);
    $response->assertOk();
});