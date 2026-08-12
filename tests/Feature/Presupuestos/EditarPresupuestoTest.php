
<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Presupuesto;

uses(RefreshDatabase::class);


it('allows the owner to view the edit budget form', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $presupuesto = Presupuesto::factory()->for($user)->create([
                    'name' => 'Boda/boda',
                    'amount' => 10005,
                    'type' => 'goal'
    ]);
    $response =   $this->actingAs($user)->get(route('Presupuestos.edit', $presupuesto));

    $response->assertOk();
    $response->assertSee('Boda/boda');

});

it('does not allow guests to view the edit budget form', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);
    $presupuesto = Presupuesto::factory()->for($user)->create();
    $response =   $this->get(route('Presupuestos.edit', $presupuesto));
    $response->assertRedirect(route('login'));


});

it('does not allow other users to view the edit budget form', function () {
    $owner = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $otherOwner = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $presupuesto = Presupuesto::factory()->for($owner)->create();

    $response = $this->actingAs($otherOwner)
        ->get(route('Presupuestos.edit', $presupuesto));

    $response->assertForbidden();
    $response->assertStatus(403);
});