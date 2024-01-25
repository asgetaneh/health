<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Vehicle;

use App\Models\Diver;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
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
    public function it_gets_vehicles_list(): void
    {
        $vehicles = Vehicle::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.vehicles.index'));

        $response->assertOk()->assertSee($vehicles[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_vehicle(): void
    {
        $data = Vehicle::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.vehicles.store'), $data);

        $this->assertDatabaseHas('vehicles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        $diver = Diver::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'plante_number' => $this->faker->randomNumber(),
            'level' => $this->faker->randomNumber(),
            'total_seats' => $this->faker->randomNumber(0),
            'description' => $this->faker->sentence(15),
            'diver_id' => $diver->id,
        ];

        $response = $this->putJson(
            route('api.vehicles.update', $vehicle),
            $data
        );

        $data['id'] = $vehicle->id;

        $this->assertDatabaseHas('vehicles', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->deleteJson(route('api.vehicles.destroy', $vehicle));

        $this->assertModelMissing($vehicle);

        $response->assertNoContent();
    }
}
