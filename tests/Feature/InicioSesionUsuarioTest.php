<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;



uses (RefreshDatabase::class);

/*muestra la pantalla de inicio de sesión*/
it('shows the login screen', function () {
    $response = $this->get(route('login')) ;

    $response->assertOk();
});

// inicia sesión con éxito como usuario verificado
it('logs in a verified user successfully', function () {
   User::factory()->create([
        // 'password' => bcrypt($password = 'password'),
        'email' => 'wilmer@example.com',
        'password' => bcrypt('$Elian2025'),
        'email_verified_at' => now(),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'wilmer@example.com',
        'password' => '$Elian2025',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
   
});

/*credenciales inválidas*/
it('fails to log in with invalid credentials', function () {
   User::factory()->create([
        'email' => 'wilmer@wilmer.com',
        'password' => bcrypt('$Elian2025'),
    ]);

    $response = $this->from(route('login'))->post(route('login.store'), [
        'email' => 'wilmer@wilmer.com',
        'password' => 'invalid-password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('error', 'Credenciales inválidas.');

    $this->assertGuest();

});

/*usuario no verificado y deriginimaso al la no pagina principal*/
it('prevents unverifd user from accessing dashboard', function () {
   User::factory()->unverified()->create([
        'email' => 'wilmer@example.com',
        'password' => bcrypt('$Elian2025'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'wilmer@example.com',
        'password' => '$Elian2025',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
    $dashboardResponse = $this->get(route('dashboard'));
    $dashboardResponse->assertRedirect(route('verification.notice'));
});

it('does not allow accces to dashboard if email is not verified', function () {
    $user = User::factory()->create([
        'email_verified_at' => null, // Usuario no verificado
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertRedirect(route('verification.notice'));
});

it('allow acces to dashboard if email is verified', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(), // Usuario verificado
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();

    // $response->assertRedirect(route('verification.notice'));
});


/*usuario que no existe y no puede iniciar sesión*/
it('fails to log in with non-existent user', function () {
    $response = $this->from(route('login'))->post(route('login.store'), [
        'email' => 'nonexistent@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors(['email' => 'El correo electrónico no está registrado.']);

    $this->assertGuest();
});
