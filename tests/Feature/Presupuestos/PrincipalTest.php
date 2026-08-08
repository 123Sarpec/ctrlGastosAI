<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Presupuesto;

uses(RefreshDatabase::class);

it('shows emty state when the user no bugget', function () {
    $user = User::factory()->create([
               'email_verified_at' => now()
    ]);
    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
    $response->assertSee('No Hay Presupuestos.');
    $response->assertSee('Comienza creando uno');

});
it('only shows the user\'s own budgets', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $otroUser = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    Presupuesto::factory()->create([
        'user_id' => $user->id,
        'name' => 'Presupuesto del usuario',
    ]);

    Presupuesto::factory()->create([
        'user_id' => $otroUser->id,
        'name' => 'Presupuesto de otro usuario',
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk();
    $response->assertSee('Presupuesto del usuario');
    $response->assertDontSee('Presupuesto de otro usuario');
});