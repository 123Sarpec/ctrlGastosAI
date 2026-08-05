<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;


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