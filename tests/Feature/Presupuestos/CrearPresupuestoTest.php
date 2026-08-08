<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Presupuesto;

uses(RefreshDatabase::class);


it('validar requimientos de crear presupustos', function () {
    $user = User::factory()->create([
               'email_verified_at' => now()
    ]);
    $response = $this->actingAs($user)
        ->from(route('Presupuestos.create'))
        ->post(route('Presupuestos.store'),[
                    'name' => '',
                    'amount' => '',
                    'type' => '',

        ]);
        
    $response->assertRedirect(route('Presupuestos.create'));
        $response->assertSessionHasErrors([
                     'name',
                    'amount' ,
                    'type',

        ]);

});

it('coes not allow guest to crate budget', function () {
    $response = $this->post(route('Presupuestos.store'),[
                    'name' => 'Boda',
                    'amount' => 1000,
                    'type' => 'goal'
    ]);

});


it('assings the created budget to the autneticacion user', function () {
    $user = User::factory()->create([
               'email_verified_at' => now()
    ]);
  $this->actingAs($user)->post(route('Presupuestos.store'),[
                    'name' => 'Boda/boda',
                    'amount' => 10005,
                    'type' => 'goal'
    ]);
        $this->assertDatabaseHas('presupuestos', [
            'name' => 'Boda/boda',
            'amount' => 10005,
            'type' => 'goal',
            'user_id' => $user->id,
        ]);
        $presupuesto = Presupuesto::first();

        expect($presupuesto->user_id)->toBe($user->id);

});

it('create a budget and redirect white succes message', function () {
    $user = User::factory()->create([
               'email_verified_at' => now()
    ]);
  $response = $this->actingAs($user)->post(route('Presupuestos.store'),[
                    'name' => 'Cumpleaños Elian',
                    'amount' => 1500,
                    'type' => 'goal'
    ]);
    $response->assertRedirect(route('dashboard'));
    // $response->assertSessionHas('success', 'Presupuesto creado correctamente.')
    $response->assertSessionHas('success', 'Presupuesto creado correctamente.');


});



it('no permitir al usuario no verificado a crear un presupuesto', function () {
    $user = User::factory()->create([
               'email_verified_at' => null
    ]);
    $response = $this->actingAs($user)->from(route('Presupuestos.create'))->post(route('Presupuestos.store'),[
                    'name' => 'viaje',
                    'amount' => 100,
                    'type' => 'goal',

        ]);
     $response->assertRedirect(route('verification.notice'));

});


it('El presupueso tiene que ser mayor 0', function () {
    $user = User::factory()->create([
               'email_verified_at' => now()
    ]);
    $response = $this->actingAs($user)
        ->from(route('Presupuestos.create'))
        ->post(route('Presupuestos.store'),[
                    'name' => 'boda',
                    'amount' => -5,
                    'type' => 'general',

        ]);
        
    $response->assertRedirect(route('Presupuestos.create'));
        $response->assertSessionHasErrors([
                    'amount' ,
        ]);

});


it('Aceptar la validacion del tipo de presupuest', function () {
    $user = User::factory()->create([
               'email_verified_at' => now()
    ]);
    $response = $this->actingAs($user)
        ->from(route('Presupuestos.create'))
        ->post(route('Presupuestos.store'),[
                    'name' => 'boda',
                    'amount' => 500,
                    'type' => 'general',

        ]);
        
    // $response->assertRedirect(route('Presupuestos.create'));
        $response->assertSessionDoesntHaveErrors( );

        $this->assertDatabaseHas('presupuestos', ['type' => 'general']);

});

