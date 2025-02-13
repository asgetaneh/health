<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Vehicle;

use App\Models\Diver;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_vehicles(): void
    {
        $vehicles = Vehicle::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('vehicles.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.vehicles.index')
            ->assertViewHas('vehicles');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_vehicle(): void
    {
        $response = $this->get(route('vehicles.create'));

        $response->assertOk()->assertViewIs('app.vehicles.create');
    }

    /**
     * @test
     */
    public function it_stores_the_vehicle(): void
    {
        $data = Vehicle::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('vehicles.store'), $data);

        $this->assertDatabaseHas('vehicles', $data);

        $vehicle = Vehicle::latest('id')->first();

        $response->assertRedirect(route('vehicles.edit', $vehicle));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->get(route('vehicles.show', $vehicle));

        $response
            ->assertOk()
            ->assertViewIs('app.vehicles.show')
            ->assertViewHas('vehicle');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->get(route('vehicles.edit', $vehicle));

        $response
            ->assertOk()
            ->assertViewIs('app.vehicles.edit')
            ->assertViewHas('vehicle');
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

        $response = $this->put(route('vehicles.update', $vehicle), $data);

        $data['id'] = $vehicle->id;

        $this->assertDatabaseHas('vehicles', $data);

        $response->assertRedirect(route('vehicles.edit', $vehicle));
    }

    /**
     * @test
     */
    public function it_deletes_the_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->delete(route('vehicles.destroy', $vehicle));

        $response->assertRedirect(route('vehicles.index'));

        $this->assertModelMissing($vehicle);
    }
}
