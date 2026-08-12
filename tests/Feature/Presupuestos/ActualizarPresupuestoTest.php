
<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Presupuesto;

uses(RefreshDatabase::class);


it('allows the owner to update a budget', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $presupuesto = Presupuesto::factory()->for($user)->create([
        'name' => 'boda',
        'amount' => 15000,
        'type' => 'general',
    ]);
    $response = $this->actingAs($user)->put(route('Presupuestos.update', $presupuesto), [
        'name' => 'Presupuesto actualizado',
        'amount' => 1500,
        'type' => 'goal',
    ]);
    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('success', 'Presupuesto actualizado correctamente.');
    $this->assertDatabaseHas('presupuestos', [
        'id' => $presupuesto->id,
        'name' => 'Presupuesto actualizado',
        'amount' => 1500,
        'type' => 'goal',
        'user_id' => $user->id,
    ]);
});


it('validates required fields when updating a budget', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $presupuesto = Presupuesto::factory()->for($user)->create();

    $response = $this->actingAs($user)
        ->from(route('Presupuestos.edit', $presupuesto))
        ->put(route('Presupuestos.update', $presupuesto), [
            'name' => '',
            'amount' => '',
            'type' => '',
        ]);

    $response->assertRedirect(route('Presupuestos.edit', $presupuesto));

    $response->assertSessionHasErrors([
        'name',
        'amount',
        'type',
    ]);
});


it('validates amount must be greater than zero when updating a budget', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $presupuesto = Presupuesto::factory()->for($user)->create();

    $response = $this->actingAs($user)
        ->from(route('Presupuestos.edit', $presupuesto))
        ->put(route('Presupuestos.update', $presupuesto), [
            'name' => 'Presupuesto',
            'amount' => 0,
            'type' => 'general',
        ]);

    $response->assertRedirect(route('Presupuestos.edit', $presupuesto));

    $response->assertSessionHasErrors([
        'amount',
    ]);
});

it('validates type must be valid when updating a budget', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $presupuesto = Presupuesto::factory()->for($user)->create();

    $response = $this->actingAs($user)
        ->from(route('Presupuestos.edit', $presupuesto))
        ->put(route('Presupuestos.update', $presupuesto), [
            'name' => 'Presupuesto',
            'amount' => 1000,
            'type' => 'not_invalid',
        ]);

    $response->assertRedirect(route('Presupuestos.edit', $presupuesto));

    $response->assertSessionHasErrors([
        'type',
    ]);
});

it('does not allow guests to update budgets', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $presupuesto = Presupuesto::factory()->for($user)->create();
    $response = $this->put(route('Presupuestos.update', $presupuesto), [
        'name' => 'boda',
        'amount' => 15000,
        'type' => 'general',
    ]);
    $response->assertRedirect(route('login'));
});

it('does not allow other users to update budgets', function () {
    $owner = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $otherUser = User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $presupuesto = Presupuesto::factory()->for($owner)->create([
        'name' => 'Presupusto Original',

    ]);

    $response = $this->actingAs($otherUser)
        ->put(route('Presupuestos.update', $presupuesto), [
            'name' => 'vulnerado',
            'amount' => 15000,
            'type' => 'goal',
        ]);
    $response->assertForbidden();
    $this->assertDatabaseHas('presupuestos', [
        'id' => $presupuesto->id,
        'name' => 'Presupusto Original',

    ]);
    // $response->assertRedirect(route('login'));

});
