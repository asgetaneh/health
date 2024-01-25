<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Diver;
use App\Models\Vehicle;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiverVehiclesTest extends TestCase
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
    public function it_gets_diver_vehicles(): void
    {
        $diver = Diver::factory()->create();
        $vehicles = Vehicle::factory()
            ->count(2)
            ->create([
                'diver_id' => $diver->id,
            ]);

        $response = $this->getJson(route('api.divers.vehicles.index', $diver));

        $response->assertOk()->assertSee($vehicles[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_diver_vehicles(): void
    {
        $diver = Diver::factory()->create();
        $data = Vehicle::factory()
            ->make([
                'diver_id' => $diver->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.divers.vehicles.store', $diver),
            $data
        );

        $this->assertDatabaseHas('vehicles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $vehicle = Vehicle::latest('id')->first();

        $this->assertEquals($diver->id, $vehicle->diver_id);
    }
}
