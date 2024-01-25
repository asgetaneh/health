<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Route;
use App\Models\Vehicle;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_vehicle_routes(): void
    {
        $vehicle = Vehicle::factory()->create();
        $routes = Route::factory()
            ->count(2)
            ->create([
                'vehicle_id' => $vehicle->id,
            ]);

        $response = $this->getJson(
            route('api.vehicles.routes.index', $vehicle)
        );

        $response->assertOk()->assertSee($routes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_vehicle_routes(): void
    {
        $vehicle = Vehicle::factory()->create();
        $data = Route::factory()
            ->make([
                'vehicle_id' => $vehicle->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.vehicles.routes.store', $vehicle),
            $data
        );

        $this->assertDatabaseHas('routes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $route = Route::latest('id')->first();

        $this->assertEquals($vehicle->id, $route->vehicle_id);
    }
}
