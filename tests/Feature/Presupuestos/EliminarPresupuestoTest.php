<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Presupuesto;

uses(RefreshDatabase::class);

it('allows the owner to delete a budget', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $presupuesto = Presupuesto::factory()->for($user)->create();

    $response = $this->actingAs($user)->delete(route('Presupuestos.destroy', $presupuesto));
    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('success', 'Presupuesto eliminado correctamente.');

    $this->assertSoftDeleted('presupuestos', [
        'id' => $presupuesto->id,
    ]);
});




/*no permite usuario no auttenticado*/
it('does not allow guests to delete budgets', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $presupuesto = Presupuesto::factory()->for($user)->create();
    $response = $this->delete(route('Presupuestos.destroy', $presupuesto));
    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('presupuestos', [
        'id' => $presupuesto->id,
    ]);
});



// no permite el usaurio no  verificadp |
it('does not allow unverified users to delete budgets', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);
    $presupuesto = Presupuesto::factory()->for($user)->create();
    $response = $this->actingAs($user)->delete(route('Presupuestos.destroy', $presupuesto));
    $response->assertRedirect(route('verification.notice'));
    $this->assertDatabaseHas('presupuestos', [
        'id' => $presupuesto->id,
    ]);
});

it('does not allow other users to delete budgets', function () {
    $owner = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $otherUser = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $presupuesto = Presupuesto::factory()->for($owner)->create([
        'name' => 'Presupuesto Original',
    ]);

    $response = $this->actingAs($otherUser)->delete(route('Presupuestos.destroy', $presupuesto));
    $response->assertForbidden();
    $response->assertSee('no tienes permiso para eliminar este presupuesto');
    $this->assertDatabaseHas('presupuestos', [
        'id' => $presupuesto->id,
        'name' => 'Presupuesto Original'
        // 'user_id' => $owner->id,
    ]);
});
